<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard', [
            "users"=>User::all(),
            'userCount' => User::count(),
            'categoryCount' => Category::count(),
            'productCount' => Product::count(),
            'orderCount' => Order::count(),
            'inventoryValue' => Product::query()->selectRaw('COALESCE(SUM(price * quantity), 0) as total')->value('total'),
            'lowStockProducts' => Product::query()->where('quantity', '<=', 5)->orderBy('quantity')->orderBy('name')->limit(6)->get(),
            'recentOrders' => Order::query()->with('user')->latest()->limit(6)->get(),
            'recentPayments' => Payment::query()->with('order.user')->latest()->limit(5)->get(),
            'revenue' => Payment::query()->where('status', 'paid')->sum('amount'),
            'categoryStats' => Category::query()->withCount('products')->orderByDesc('products_count')->limit(5)->get(),
        ]);
    }
}
