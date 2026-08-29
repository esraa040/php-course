@extends('layouts.app')

@section('title', 'Edit product')
@section('eyebrow', 'Catalog')
@section('heading', 'Edit product')

@section('actions')
    <a href="{{ route('products.index') }}" class="btn btn-ghost">Back to products</a>
@endsection

@section('content')
    <section class="card form-card">
        <form class="card-pad" action="{{ route('products.update', $product->id) }}" method="post">
            @csrf
            @method('put')

            <div class="field">
                <label for="name">Product name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}">
                @error('name')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="3">{{ old('description', $product->description) }}</textarea>
                @error('description')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="price">Price</label>
                <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price) }}">
                @error('price')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="quantity">Stock <span class="hint">(units available)</span></label>
                <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $product->quantity) }}">
                @error('quantity')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id">
                    @foreach ($categories as $row)
                        <option value="{{ $row->id }}" @selected(old('category_id', $product->category_id) == $row->id)>{{ $row->name }}</option>
                    @endforeach
                </select>
                @error('category_id')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <a href="{{ route('products.index') }}" class="btn btn-ghost">Cancel</a>
            </div>
        </form>
    </section>
@endsection
