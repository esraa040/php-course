<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private function cart()
    {
        return session()->get('cart', []);
    }

    public function index()
    {
        $cart = $this->cart();

        $total = 0;
        foreach ($cart as $line) {
            $total = $total + $line['price'] * $line['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    public function store(Request $request, string $id)
    {
        $product = Product::findorfail($id);

        if ($product->quantity < 1) {
            return back()->with('error', $product->name . ' is out of stock.');
        }

        $cart = $this->cart();
        $inCart = $cart[$product->id]['quantity'] ?? 0;

        if ($inCart + 1 > $product->quantity) {
            return back()->with('error', 'Only ' . $product->quantity . ' of ' . $product->name . ' left in stock.');
        }

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $inCart + 1;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', $product->name . ' was added to your cart');
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = $this->cart();

        if (isset($cart[$id])) {
            $wanted = (int) $request->quantity;
            $product = Product::find($id);

            if ($product && $wanted > $product->quantity) {
                return to_route('cart.index')
                    ->with('error', 'Only ' . $product->quantity . ' of ' . $product->name . ' left in stock.');
            }

            $cart[$id]['quantity'] = $wanted;
            session()->put('cart', $cart);
        }

        return to_route('cart.index')->with('success', 'Cart updated');
    }

    public function destroy(string $id)
    {
        $cart = $this->cart();

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return to_route('cart.index')->with('success', 'Product removed from your cart');
    }

    public function clear()
    {
        session()->forget('cart');

        return to_route('cart.index')->with('success', 'Your cart is empty now');
    }
}
