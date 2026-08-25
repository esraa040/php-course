<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>update order item</title>
    <x-bootstrap-css></x-bootstrap-css>
</head>

<body>
    <x-navbar></x-navbar>
    <h1 style="text-align: center;color:red"> Update Order Item </h1>
    <form class="w-75 m-auto border border-1 p-5" action="{{ route('order_items.update',$order_item["id"]) }}" method="post">
        @csrf
        @method('put')

        <div class="mb-3">
            @error('order_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="order_id" class="form-label">Order</label>
            <select class="form-control" name="order_id" id="order_id">
                @foreach($orders as $row)
                <option value="{{ $row->id }}" @selected(old('order_id', $order_item->order_id) == $row->id)>{{ $row->id }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            @error('product_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="product_id" class="form-label">Product</label>
            <select class="form-control" name="product_id" id="product_id">
                @foreach($products as $row)
                <option value="{{ $row->id }}" @selected(old('product_id', $order_item->product_id) == $row->id)>{{ $row->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            @error('quantity')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="quantity" class="form-label">Quantity</label>
            <input type="text" class="form-control" name="quantity" id="quantity" value="{{ old('quantity', $order_item["quantity"]) }}">
        </div>
        <div class="mb-3">
            @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" name="price" id="price" value="{{ old('price', $order_item["price"]) }}">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>

    <x-bootstrap-js></x-bootstrap-js>

</body>

</html>
