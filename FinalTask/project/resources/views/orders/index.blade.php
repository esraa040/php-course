@extends('layouts.app')

@section('title', 'Orders')
@section('eyebrow', 'Administration')
@section('heading', 'Orders')
@section('lede', 'Every order placed in the store.')

@section('actions')
    <a href="{{ route('orders.create') }}" class="btn btn-primary">Add order</a>
@endsection

@section('content')
    <section class="card">
        <div class="tbl-wrap">
            <table class="tbl">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        @php($total = $order->order_items->sum(fn($item) => $item->price * $item->quantity))
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td><strong>{{ $order->user?->name ?? 'deleted user' }}</strong></td>
                            <td>{{ $order->order_items->sum('quantity') }}</td>
                            <td><strong>${{ number_format($total, 2) }}</strong></td>
                            <td class="muted">{{ $order->created_at?->format('d M Y') }}</td>
                            <td>
                                <div class="row-actions">
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-view btn-sm">View</a>
                                    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-edit btn-sm">Edit</a>
                                    <form action="{{ route('orders.destroy', $order->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty">No orders yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
