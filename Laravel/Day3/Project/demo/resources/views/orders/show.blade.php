<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order</title>
    <x-bootstrap-css></x-bootstrap-css>
</head>

<body>
    <x-navbar></x-navbar>
    <h1 style="text-align: center;color:red"> Order Details </h1>

    <table class="table table-striped w-75 m-auto">
        <thead>
            <th>id</th>
            <th>User</th>
            <th>Date</th>
            <th>Action</th>
        </thead>
        <tbody>
            <tr>
                <td>{{ $order["id"] }}</td>
                <td><a href="{{ route('users.show',$order->user_id) }}">{{ $order->user->name }}</a></td>
                <td>{{ $order["created_at"] }}</td>
                <td class="d-flex justify-content-around">
                    <div>
                        <a href="{{ route('orders.index') }}"><button class="btn btn-success">Back</button></a>
                    </div>
                    <form action="{{ route('orders.edit',$order["id"]) }}" method="get">
                        <button class="btn btn-primary">Edit</button>
                    </form>
                    <form action="{{ route('orders.destroy',$order["id"]) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        </tbody>

    </table>
    <hr>

    <h2 class="text-center text-success"> Order Items </h2>

    <table class="table table-striped w-75 m-auto">
        <thead>
            <th>id</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Subtotal</th>
        </thead>
        <tbody>
            @foreach($order->order_items as $item)
            <tr>
                <td>{{ $item["id"] }}</td>
                <td><a href="{{ route('products.show',$item->product_id) }}">{{ $item->product->name }}</a></td>
                <td>{{ $item["quantity"] }}</td>
                <td>{{ $item["price"] }}</td>
                <td>{{ $item->price * $item->quantity }}</td>
            </tr>

            @endforeach
        </tbody>

    </table>

    <x-bootstrap-js></x-bootstrap-js>

</body>

</html>
