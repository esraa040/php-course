@extends('layouts.app')

@section('title', 'Products')
@section('eyebrow', 'Catalog')
@section('heading', 'Products')
@section('lede', 'Browse the available collection and add items to your cart.')

@section('actions')
    @if (auth()->user()->role === 'admin')
        <a href="{{ route('products.create') }}" class="btn btn-primary">Add product</a>
    @endif
@endsection

@section('content')
    <div class="grid-3">
        @forelse ($products as $product)
            <article class="prod">
                <div class="prod-top">
                    <span class="prod-cat">{{ $product->category?->name ?? 'Uncategorised' }}</span>
                    @if ($product->quantity > 0)
                        <span class="badge badge-green">{{ $product->quantity }} in stock</span>
                    @else
                        <span class="badge badge-gray">Out of stock</span>
                    @endif
                </div>

                <h3>{{ $product->name }}</h3>
                <p>{{ $product->description }}</p>
                <div class="prod-price">${{ number_format($product->price, 2) }}</div>

                <div class="prod-actions">
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-ghost btn-sm">View details</a>

                    <form action="{{ route('cart.store', $product->id) }}" method="post">
                        @csrf
                        <button class="btn btn-primary btn-sm" @disabled($product->quantity < 1)>Add to cart</button>
                    </form>

                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-edit btn-sm">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    @endif
                </div>
            </article>
        @empty
            <div class="card empty">No products in the catalogue yet.</div>
        @endforelse
    </div>
@endsection
