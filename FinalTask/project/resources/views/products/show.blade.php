@extends('layouts.app')

@section('title', $product->name)
@section('eyebrow', $product->category?->name ?? 'Catalog')
@section('heading', $product->name)

@section('actions')
    <a href="{{ route('products.index') }}" class="btn btn-ghost">Back to products</a>
    @if (auth()->user()->role === 'admin')
        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-edit">Edit</a>
        <form action="{{ route('products.destroy', $product->id) }}" method="post">
            @csrf
            @method('delete')
            <button class="btn btn-danger">Delete</button>
        </form>
    @endif
@endsection

@section('content')
    <div class="two-col">
        <section class="card">
            <div class="card-head">
                <h2>Details</h2>
                @if ($product->quantity > 0)
                    <span class="badge badge-green">{{ $product->quantity }} in stock</span>
                @else
                    <span class="badge badge-gray">Out of stock</span>
                @endif
            </div>
            <div class="card-pad">
                <dl class="kv">
                    <dt>Product ID</dt>
                    <dd>#{{ $product->id }}</dd>
                    <dt>Category</dt>
                    <dd><a class="stat-link" href="{{ route('categories.show', $product->category_id) }}">{{ $product->category?->name ?? 'Uncategorised' }}</a></dd>
                    <dt>Price</dt>
                    <dd><strong>${{ number_format($product->price, 2) }}</strong></dd>
                    <dt>Stock</dt>
                    <dd>{{ $product->quantity }} units</dd>
                    <dt>Description</dt>
                    <dd>{{ $product->description }}</dd>
                </dl>

                <div class="form-actions">
                    <form action="{{ route('cart.store', $product->id) }}" method="post">
                        @csrf
                        <button class="btn btn-primary" @disabled($product->quantity < 1)>Add to cart</button>
                    </form>
                </div>
            </div>
        </section>

        <section class="card">
            <div class="card-head">
                <h2>Orders with this product</h2>
                <span class="muted">{{ $product->order_items->count() }}</span>
            </div>
            <div class="tbl-wrap">
                <table class="tbl">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($product->order_items as $item)
                            <tr>
                                <td><a class="stat-link" href="{{ route('orders.show', $item->order_id) }}">#{{ $item->order_id }}</a></td>
                                <td>{{ $item->quantity }}</td>
                                <td>${{ number_format($item->price, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="empty">This product has not been ordered yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
