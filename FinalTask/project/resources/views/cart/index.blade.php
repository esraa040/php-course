@extends('layouts.app')

@section('title', 'Cart')
@section('eyebrow', 'Shopping')
@section('heading', 'Your cart')
@section('lede', 'Review the items you picked, adjust quantities and check your total.')

@section('actions')
    <a href="{{ route('products.index') }}" class="btn btn-ghost">Continue shopping</a>
    @if (count($cart) > 0)
        <form action="{{ route('cart.clear') }}" method="post">
            @csrf
            <button class="btn btn-danger">Clear cart</button>
        </form>
    @endif
@endsection

@section('content')
    @if (count($cart) == 0)
        <section class="card">
            <div class="empty">
                <p style="font-size:17px;font-weight:600;color:var(--ink);margin:0 0 6px">Your cart is empty</p>
                <p style="margin:0 0 18px">Add a few products and they will show up here.</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary">Browse products</a>
            </div>
        </section>
    @else
        <div class="two-col">
            <section class="card">
                <div class="card-head">
                    <h2>Items</h2>
                    <span class="muted">{{ count($cart) }} {{ count($cart) === 1 ? 'product' : 'products' }}</span>
                </div>
                <div class="tbl-wrap">
                    <table class="tbl">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $line)
                                <tr>
                                    <td><strong>{{ $line['name'] }}</strong></td>
                                    <td>${{ number_format($line['price'], 2) }}</td>
                                    <td>
                                        <form action="{{ route('cart.update', $line['id']) }}" method="post"
                                            style="display:flex;gap:8px;align-items:center">
                                            @csrf
                                            @method('put')
                                            <input type="number" name="quantity" value="{{ $line['quantity'] }}" min="1"
                                                style="width:78px;padding:7px 10px;border:1px solid var(--line);border-radius:8px;font:inherit">
                                            <button class="btn btn-ghost btn-sm">Save</button>
                                        </form>
                                    </td>
                                    <td><strong>${{ number_format($line['price'] * $line['quantity'], 2) }}</strong></td>
                                    <td>
                                        <form action="{{ route('cart.destroy', $line['id']) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="card">
                <div class="card-head">
                    <h2>Summary</h2>
                </div>
                <div class="card-pad">
                    <div style="display:flex;justify-content:space-between;padding:8px 0;color:var(--muted)">
                        <span>Items</span>
                        <span>{{ collect($cart)->sum('quantity') }}</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;padding:8px 0;border-top:1px solid var(--line);margin-top:8px">
                        <strong>Total</strong>
                        <strong style="font-size:22px;letter-spacing:-.5px">${{ number_format($total, 2) }}</strong>
                    </div>
                    <div style="margin-top:16px">
                        <a href="{{ route('products.index') }}" class="btn btn-primary" style="width:100%">Add more products</a>
                    </div>
                </div>
            </section>
        </div>
    @endif
@endsection
