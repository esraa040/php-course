<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Item</title>
    <x-bootstrap-css></x-bootstrap-css>
</head>

<body>
    <x-navbar></x-navbar>
    <h1 style="text-align: center;color:red"> Order Item Details </h1>

    <table class="table table-striped w-75 m-auto">
        <thead>
            <th>id</th>
            <th>Order</th>
            <th>User</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Subtotal</th>
            <th>Action</th>
        </thead>
        <tbody>
            <tr>
                <td>{{ $order_item["id"] }}</td>
                <td><a href="{{ route('orders.show',$order_item->order_id) }}">{{ $order_item["order_id"] }}</a></td>
                <td><a href="{{ route('users.show',$order_item->order->user_id) }}">{{ $order_item->order->user->name }}</a></td>
                <td><a href="{{ route('products.show',$order_item->product_id) }}">{{ $order_item->product->name }}</a></td>
                <td>{{ $order_item["quantity"] }}</td>
                <td>{{ $order_item["price"] }}</td>
                <td>{{ $order_item->price * $order_item->quantity }}</td>
                <td class="d-flex justify-content-around">
                    <div>
                        <a href="{{ route('order_items.index') }}"><button class="btn btn-success">Back</button></a>
                    </div>
                    <form action="{{ route('order_items.edit',$order_item["id"]) }}" method="get">
                        <button class="btn btn-primary">Edit</button>
                    </form>
                    <form action="{{ route('order_items.destroy',$order_item["id"]) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        </tbody>

    </table>

    <x-bootstrap-js></x-bootstrap-js>

</body>

</html>
