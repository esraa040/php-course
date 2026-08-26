<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product</title>
    <x-bootstrap-css></x-bootstrap-css>
</head>

<body>
    <x-navbar></x-navbar>
    <h1 style="text-align: center;color:red"> Product Details </h1>

    <table class="table table-striped w-75 m-auto">
        <thead>
            <th>id</th>
            <th>Name</th>
            <th>Description</th>
            <th>Category</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Action</th>
        </thead>
        <tbody>
            <tr>
                <td>{{ $product["id"] }}</td>
                <td>{{ $product["name"] }}</td>
                <td>{{ $product["description"] }}</td>
                <td>
                    <a href="{{ route('categories.show',$product->category_id) }}">{{ $product->category->name }}</a>
                </td>
                <td>{{ $product["price"] }}</td>
                <td>{{ $product["quantity"] }}</td>
                <td class="d-flex justify-content-around">
                    <div>
                        <a href="{{ route('products.index') }}"><button class="btn btn-success">Back</button></a>
                    </div>
                    <form action="{{ route('products.edit',$product["id"]) }}" method="get">
                        <button class="btn btn-primary">Edit</button>
                    </form>
                    <form action="{{ route('products.destroy',$product["id"]) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        </tbody>

    </table>
    <hr>

    <h2 class="text-center text-success"> Orders containing this product </h2>

    <table class="table table-striped w-75 m-auto">
        <thead>
            <th>Order id</th>
            <th>Quantity</th>
            <th>Price</th>
        </thead>
        <tbody>
            @foreach($product->order_items as $item)
            <tr>
                <td><a href="{{ route('orders.show',$item->order_id) }}">{{ $item->order_id }}</a></td>
                <td>{{ $item["quantity"] }}</td>
                <td>{{ $item["price"] }}</td>
            </tr>

            @endforeach
        </tbody>

    </table>

    <x-bootstrap-js></x-bootstrap-js>

</body>

</html>
