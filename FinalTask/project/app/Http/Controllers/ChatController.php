<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;

class ChatController extends Controller
{
    private const ADMIN_ONLY = ['user', 'admin', 'account', 'role', 'staff', 'revenue', 'payment', 'dashboard', 'order'];

    public function index()
    {
        return view('chat.index');
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        if (!Auth::check()) {
            return response()->json([
                'error' => 'Please log in before using the assistant.'
            ], 401);
        }

        $user = Auth::user();
        $isAdmin = ($user->role ?? 'user') === 'admin';
        $message = $request->message;

        if (!$isAdmin && $this->needsAdmin($message)) {
            return response()->json([
                'error' => 'Sorry ' . $user->name . ', that is admin workspace information and the assistant '
                    . 'answers it for admin accounts only. Your role is "' . ($user->role ?? 'user') . '", '
                    . 'so you can ask me about products, stock and your own cart instead.'
            ], 403);
        }

        $apiKey = env('OPENAI_API_KEY');

        if (!$apiKey) {
            return response()->json([
                'reply' => $this->localAnswer($message, $user, $isAdmin)
            ]);
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'system', 'content' => $this->systemPrompt($user, $isAdmin)],
                ['role' => 'user', 'content' => $message],
            ],
        ]);

        if ($response->successful()) {
            $reply = $response->json()['choices'][0]['message']['content'] ?? null;
            return response()->json(['reply' => $reply ?: $this->localAnswer($message, $user, $isAdmin)]);
        }

        return response()->json(['reply' => $this->localAnswer($message, $user, $isAdmin)]);
    }

    private function needsAdmin(string $message): bool
    {
        $q = mb_strtolower($message);

        foreach (self::ADMIN_ONLY as $word) {
            if (str_contains($q, $word)) {
                if (in_array($word, ['user', 'admin', 'account', 'role'], true) && $this->isPermissionQuestion($q)) {
                    continue;
                }
                return true;
            }
        }

        return false;
    }

    private function isPermissionQuestion(string $q): bool
    {
        foreach (['what can', 'what do i', 'am i', 'can i', 'my permission', 'my role', 'allowed'] as $phrase) {
            if (str_contains($q, $phrase)) {
                return true;
            }
        }

        return false;
    }

    private function systemPrompt($user, bool $isAdmin): string
    {
        $context = [
            'current_user' => [
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role ?? 'user',
            ],
            'products' => Product::with('category')->get()
                ->map(fn($p) => [
                    'name' => $p->name,
                    'description' => $p->description,
                    'price' => $p->price,
                    'stock' => $p->quantity,
                    'category' => $p->category?->name,
                ])->toArray(),
            'categories' => Category::pluck('name')->toArray(),
            'cart' => array_values(session()->get('cart', [])),
        ];

        if ($isAdmin) {
            $context['admin_only'] = [
                'total_users' => User::count(),
                'total_admins' => User::where('role', 'admin')->count(),
                'total_orders' => Order::count(),
                'revenue_collected' => Payment::where('status', 'paid')->sum('amount'),
                'users' => User::get(['name', 'email', 'role'])->toArray(),
            ];
        }

        $prompt = "You are Vibe Assistant, the assistant inside a store called Vibe Commerce. "
            . "Answer in English, briefly and helpfully, using ONLY this data:\n"
            . json_encode($context, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        $prompt .= $isAdmin
            ? "\n\nThis user is an ADMIN and may ask about anything above, including admin_only data."
            : "\n\nThis user is a NORMAL USER. Never reveal information about other users, orders, payments or "
                . "revenue. If asked about those, say it is available to admin accounts only.";

        return $prompt;
    }

    private function localAnswer(string $message, $user, bool $isAdmin): string
    {
        $q = mb_strtolower(trim($message));

        if (preg_match('/^(hi|hey|hello|salam|good morning|good evening)\b/', $q)) {
            return 'Hi ' . $user->name . '! Ask me about the products, their stock and prices, or your cart.'
                . ($isAdmin ? ' As an admin you can also ask about users, orders and revenue.' : '');
        }

        if ($this->isPermissionQuestion($q)) {
            if (str_contains($q, 'admin')) {
                $answer = 'An admin can open the control center, manage users, categories, products, orders and payments, '
                    . 'and use every tool in the navigation bar.';
                return $isAdmin
                    ? 'Admin access confirmed. ' . $answer
                    : $answer . ' Your account is a normal user, so those tools are hidden from you.';
            }

            return 'As a user you can browse the products, open a product to see its details, add products to your cart, '
                . 'change quantities or remove items in your cart, and chat with me here.'
                . ($isAdmin ? ' You are an admin, so you also get the admin tools.' : '');
        }

        if (str_contains($q, 'cart') || str_contains($q, 'basket')) {
            $cart = session()->get('cart', []);

            if (count($cart) === 0) {
                return 'Your cart is empty right now. Open the Products page and press "Add to cart" on anything you like.';
            }

            $total = 0;
            $lines = [];
            foreach ($cart as $line) {
                $total += $line['price'] * $line['quantity'];
                $lines[] = $line['name'] . ' x' . $line['quantity'] . ' ($' . number_format($line['price'] * $line['quantity'], 2) . ')';
            }

            return 'Your cart holds ' . count($cart) . ' product(s): ' . implode(', ', $lines)
                . '. The total is $' . number_format($total, 2) . '.';
        }

        if (str_contains($q, 'expensive') || str_contains($q, 'highest') || str_contains($q, 'most costly')) {
            $product = Product::orderByDesc('price')->first();
            return $product
                ? 'The most expensive product is ' . $product->name . ' at $' . number_format($product->price, 2) . '.'
                : 'There are no products yet.';
        }

        if (str_contains($q, 'cheap') || str_contains($q, 'lowest')) {
            $product = Product::orderBy('price')->first();
            return $product
                ? 'The cheapest product is ' . $product->name . ' at $' . number_format($product->price, 2) . '.'
                : 'There are no products yet.';
        }

        if ($found = $this->findProduct($q)) {
            return $found->name . ' costs $' . number_format($found->price, 2)
                . ', sits in the ' . ($found->category?->name ?? 'uncategorised') . ' category, and is '
                . ($found->quantity > 0 ? 'in stock with ' . $found->quantity . ' unit(s) left' : 'out of stock')
                . '.' . ($found->description ? ' ' . $found->description : '');
        }

        if (str_contains($q, 'stock') || str_contains($q, 'out of')) {
            $out = Product::where('quantity', '<=', 0)->pluck('name')->implode(', ');
            $low = Product::where('quantity', '>', 0)->where('quantity', '<=', 5)->pluck('name')->implode(', ');

            $parts = [];
            if ($low !== '') {
                $parts[] = 'low on stock: ' . $low;
            }
            if ($out !== '') {
                $parts[] = 'out of stock: ' . $out;
            }

            return $parts === []
                ? 'Every product has more than 5 units in stock.'
                : 'Stock report - ' . implode('; ', $parts) . '.';
        }

        if (str_contains($q, 'categor')) {
            $names = Category::pluck('name')->implode(', ');
            return Category::count() === 0
                ? 'There are no categories yet.'
                : 'There are ' . Category::count() . ' categories: ' . $names . '.';
        }

        if ($isAdmin) {
            if (str_contains($q, 'revenue') || str_contains($q, 'income') || str_contains($q, 'earn')) {
                return 'Collected revenue from paid payments is $'
                    . number_format(Payment::where('status', 'paid')->sum('amount'), 2) . '.';
            }

            if (str_contains($q, 'payment')) {
                return 'There are ' . Payment::count() . ' payments: '
                    . Payment::where('status', 'paid')->count() . ' paid, '
                    . Payment::where('status', 'pending')->count() . ' pending and '
                    . Payment::where('status', 'refunded')->count() . ' refunded.';
            }

            if (str_contains($q, 'order')) {
                return 'There are ' . Order::count() . ' orders in the system.';
            }

            if (str_contains($q, 'user') || str_contains($q, 'account') || str_contains($q, 'admin')) {
                $admins = User::where('role', 'admin')->count();
                return 'Admin access confirmed. There are ' . User::count() . ' users, ' . $admins
                    . ' of them ' . ($admins === 1 ? 'is an admin' : 'are admins') . '.';
            }
        }

        foreach (['product', 'item', 'catalog', 'available', 'show me', 'list', 'buy', 'sell', 'price'] as $word) {
            if (str_contains($q, $word)) {
                $products = Product::with('category')->get();

                if ($products->isEmpty()) {
                    return 'There are no products in the catalogue yet.';
                }

                $lines = $products->map(function ($p) {
                    $stock = $p->quantity > 0 ? $p->quantity . ' in stock' : 'out of stock';
                    return '- ' . $p->name . ' (' . ($p->category?->name ?? 'uncategorised') . ') - $'
                        . number_format($p->price, 2) . ', ' . $stock;
                })->implode("\n");

                return 'There are ' . $products->count() . " products:\n" . $lines;
            }
        }

        $extra = $isAdmin ? ', users, orders, payments and revenue' : '';

        return 'I can help with products, prices, stock, categories and your cart' . $extra . '. '
            . 'Try "show me the available products", "is the smartphone in stock" or "what is in my cart".';
    }

    private function findProduct(string $q)
    {
        $stop = ['the', 'and', 'are', 'for', 'you', 'how', 'many', 'what', 'have', 'has', 'about', 'tell', 'show',
            'much', 'does', 'this', 'that', 'there', 'stock', 'price', 'cost', 'product', 'products', 'available',
            'with', 'from', 'your', 'mine', 'they', 'them', 'left'];

        foreach (preg_split('/[^a-z0-9]+/', $q, -1, PREG_SPLIT_NO_EMPTY) as $word) {
            if (mb_strlen($word) < 4 || in_array($word, $stop, true)) {
                continue;
            }

            $found = Product::with('category')->where('name', 'like', '%' . $word . '%')->first();
            if ($found) {
                return $found;
            }
        }

        return null;
    }
}
