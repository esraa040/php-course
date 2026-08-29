@extends('layouts.app')

@section('title', $category->name)
@section('eyebrow', 'Administration')
@section('heading', $category->name)
@section('lede', $category->description)

@section('actions')
    <a href="{{ route('categories.index') }}" class="btn btn-ghost">Back to categories</a>
    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-edit">Edit</a>
    <form action="{{ route('categories.destroy', $category->id) }}" method="post">
        @csrf
        @method('delete')
        <button class="btn btn-danger">Delete</button>
    </form>
@endsection

@section('content')
    <section class="card">
        <div class="card-head">
            <h2>Products in this category</h2>
            <span class="muted">{{ $category->products->count() }}</span>
        </div>
        <div class="tbl-wrap">
            <table class="tbl">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($category->products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td><strong>{{ $product->name }}</strong></td>
                            <td>${{ number_format($product->price, 2) }}</td>
                            <td>
                                @if ($product->quantity > 0)
                                    <span class="badge badge-green">{{ $product->quantity }} in stock</span>
                                @else
                                    <span class="badge badge-gray">Out of stock</span>
                                @endif
                            </td>
                            <td>
                                <div class="row-actions">
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-view btn-sm">View</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty">No products in this category yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
