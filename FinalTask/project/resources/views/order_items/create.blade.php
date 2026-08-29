@extends('layouts.app')

@section('title', 'Add order item')
@section('eyebrow', 'Administration')
@section('heading', 'Add order item')
@section('lede', 'Attach a product line to an existing order.')

@section('actions')
    <a href="{{ route('order_items.index') }}" class="btn btn-ghost">Back to order items</a>
@endsection

@section('content')
    <section class="card form-card">
        <form class="card-pad" action="{{ route('order_items.store') }}" method="post">
            @csrf

            <div class="field">
                <label for="order_id">Order</label>
                <select name="order_id" id="order_id">
                    @foreach ($orders as $row)
                        <option value="{{ $row->id }}" @selected(old('order_id') == $row->id)>#{{ $row->id }}</option>
                    @endforeach
                </select>
                @error('order_id')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="product_id">Product</label>
                <select name="product_id" id="product_id">
                    @foreach ($products as $row)
                        <option value="{{ $row->id }}" @selected(old('product_id') == $row->id)>{{ $row->name }}</option>
                    @endforeach
                </select>
                @error('product_id')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" value="{{ old('quantity', 1) }}" min="1">
                @error('quantity')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="price">Price</label>
                <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}">
                @error('price')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Create order item</button>
                <a href="{{ route('order_items.index') }}" class="btn btn-ghost">Cancel</a>
            </div>
        </form>
    </section>
@endsection
