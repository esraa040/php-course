@extends('layouts.app')

@section('title', 'Order')
@section('eyebrow', 'Administration')
@section('heading', 'Order #' . $order->id)
@section('lede', 'Placed by ' . ($order->user?->name ?? 'a deleted user'))

@section('actions')
    <a href="{{ route('orders.index') }}" class="btn btn-ghost">Back to orders</a>
    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-edit">Edit</a>
    <form action="{{ route('orders.destroy', $order->id) }}" method="post">
        @csrf
        @method('delete')
        <button class="btn btn-danger">Delete</button>
    </form>
@endsection

@section('content')
    @php($total = $order->order_items->sum(fn($item) => $item->price * $item->quantity))
    <div class="two-col">
        <section class="card">
            <div class="card-head">
                <h2>Items</h2>
                <span class="muted">{{ $order->order_items->count() }}</span>
            </div>
            <div class="tbl-wrap">
                <table class="tbl">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($order->order_items as $item)
                            <tr>
                                <td><strong>{{ $item->product?->name ?? 'deleted product' }}</strong></td>
                                <td>{{ $item->quantity }}</td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td><strong>${{ number_format($item->price * $item->quantity, 2) }}</strong></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="empty">This order has no items.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <section class="card">
            <div class="card-head">
                <h2>Summary</h2>
            </div>
            <div class="card-pad">
                <dl class="kv" style="grid-template-columns: 110px 1fr">
                    <dt>Order ID</dt>
                    <dd>#{{ $order->id }}</dd>
                    <dt>Customer</dt>
                    <dd>{{ $order->user?->name ?? 'deleted user' }}</dd>
                    <dt>Items</dt>
                    <dd>{{ $order->order_items->sum('quantity') }}</dd>
                    <dt>Total</dt>
                    <dd><strong>${{ number_format($total, 2) }}</strong></dd>
                    <dt>Placed</dt>
                    <dd>{{ $order->created_at?->format('d M Y, H:i') }}</dd>
                </dl>
            </div>
        </section>
    </div>
@endsection
