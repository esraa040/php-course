<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ALL Orders</title>
    <x-bootstrap-css></x-bootstrap-css>
</head>

<body>
    <x-navbar></x-navbar>
    <h1 style="text-align: center;color:red"> All Orders Page </h1>
    <a href="{{ route('orders.create') }}">
    <x-button class="info" content="Add Order"></x-button>
    </a>

    <table class="table table-striped w-75 m-auto">
        <thead>
            <th>id</th>
            <th>User</th>
            <th>Date</th>
            <th>Items</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order["id"] }}</td>
                <td><a href="{{ route('users.show',$order->user_id) }}">{{ $order->user->name }}</a></td>
                <td>{{ $order["created_at"] }}</td>
                <td>{{ $order->order_items->count() }}</td>
                <td class="d-flex justify-content-around">
                    <div>
                        <a href="{{ route('orders.show',$order["id"]) }}"><button class="btn btn-warning">View</button></a>
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

            @endforeach
        </tbody>

    </table>

    <x-bootstrap-js></x-bootstrap-js>

</body>

</html>
