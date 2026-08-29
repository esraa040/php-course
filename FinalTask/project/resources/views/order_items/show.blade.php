@extends('layouts.app')

@section('title', 'Order item')
@section('eyebrow', 'Administration')
@section('heading', 'Order item #' . $order_item->id)

@section('actions')
    <a href="{{ route('order_items.index') }}" class="btn btn-ghost">Back to order items</a>
    <a href="{{ route('order_items.edit', $order_item->id) }}" class="btn btn-edit">Edit</a>
    <form action="{{ route('order_items.destroy', $order_item->id) }}" method="post">
        @csrf
        @method('delete')
        <button class="btn btn-danger">Delete</button>
    </form>
@endsection

@section('content')
    <section class="card form-card">
        <div class="card-pad">
            <dl class="kv" style="grid-template-columns: 130px 1fr">
                <dt>Item ID</dt>
                <dd>#{{ $order_item->id }}</dd>
                <dt>Order</dt>
                <dd><a class="stat-link" href="{{ route('orders.show', $order_item->order_id) }}">#{{ $order_item->order_id }}</a></dd>
                <dt>Product</dt>
                <dd>{{ $order_item->product?->name ?? 'deleted product' }}</dd>
                <dt>Quantity</dt>
                <dd>{{ $order_item->quantity }}</dd>
                <dt>Price</dt>
                <dd>${{ number_format($order_item->price, 2) }}</dd>
                <dt>Subtotal</dt>
                <dd><strong>${{ number_format($order_item->price * $order_item->quantity, 2) }}</strong></dd>
            </dl>
        </div>
    </section>
@endsection
