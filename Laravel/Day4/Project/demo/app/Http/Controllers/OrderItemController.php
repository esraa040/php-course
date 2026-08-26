<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order_Item;
use App\Models\Order;
use App\Models\Product;
use App\Http\Requests\OrderItemRequest;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order_items = Order_Item::all();
        return view('order_items.index', compact('order_items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orders = Order::all();
        $products = Product::all();
        return view('order_items.create', compact('orders', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderItemRequest $request)
    {
        Order_Item::create($request->validated());
        return to_route('order_items.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order_item = Order_Item::findorfail($id);
        return view('order_items.show', compact('order_item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order_item = Order_Item::findorfail($id);
        $orders = Order::all();
        $products = Product::all();
        return view('order_items.update', compact('order_item', 'orders', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderItemRequest $request, string $id)
    {
        $order_item = Order_Item::findorfail($id);
        $order_item->update($request->validated());
        return to_route('order_items.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order_item = Order_Item::findorfail($id);
        $order_item->delete();
        return to_route('order_items.index');
    }
}
