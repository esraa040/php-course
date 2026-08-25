<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>update product</title>
    <x-bootstrap-css></x-bootstrap-css>
</head>

<body>
    <x-navbar></x-navbar>
    <h1 style="text-align: center;color:red"> Update Product </h1>
    <form class="w-75 m-auto border border-1 p-5" action="{{ route('products.update',$product["id"]) }}" method="post">
        @csrf
        @method('put')

        <div class="mb-3">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $product["name"]) }}">
        </div>
        <div class="mb-3">
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="description" class="form-label">Product Description</label>
            <input type="text" class="form-control" name="description" id="description" value="{{ old('description', $product["description"]) }}">
        </div>
        <div class="mb-3">
            @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" name="price" id="price" value="{{ old('price', $product["price"]) }}">
        </div>
        <div class="mb-3">
            @error('quantity')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="quantity" class="form-label">Quantity</label>
            <input type="text" class="form-control" name="quantity" id="quantity" value="{{ old('quantity', $product["quantity"]) }}">
        </div>
        <div class="mb-3">
            @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="category_id" class="form-label">Category</label>
            <select class="form-control" name="category_id" id="category_id">
                @foreach($categories as $row)
                <option value="{{ $row->id }}" @selected(old('category_id', $product->category_id) == $row->id)>{{ $row->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>

    <x-bootstrap-js></x-bootstrap-js>

</body>

</html>
