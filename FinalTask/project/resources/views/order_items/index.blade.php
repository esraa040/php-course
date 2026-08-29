@extends('layouts.app')

@section('title', 'Order items')
@section('eyebrow', 'Administration')
@section('heading', 'Order items')
@section('lede', 'Every line inside every order.')

@section('actions')
    <a href="{{ route('order_items.create') }}" class="btn btn-primary">Add order item</a>
@endsection

@section('content')
    <section class="card">
        <div class="tbl-wrap">
            <table class="tbl">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Order</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($order_items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td><a class="stat-link" href="{{ route('orders.show', $item->order_id) }}">#{{ $item->order_id }}</a></td>
                            <td><strong>{{ $item->product?->name ?? 'deleted product' }}</strong></td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->price, 2) }}</td>
                            <td>
                                <div class="row-actions">
                                    <a href="{{ route('order_items.show', $item->id) }}" class="btn btn-view btn-sm">View</a>
                                    <a href="{{ route('order_items.edit', $item->id) }}" class="btn btn-edit btn-sm">Edit</a>
                                    <form action="{{ route('order_items.destroy', $item->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty">No order items yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
