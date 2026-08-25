<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <title>profile</title>
</head>
<body>
<x-navbar></x-navbar>

<h1 style="text-align: center;color:red"> {{ $user['name'] }} Page</h1>
{{-- @dump($users) --}}

<table class="table table-striped w-75 m-auto">
    <thead>
        <th>
            id
        </th>
        <th>
            Name
        </th>
        <th>
            Email
        </th>
        <th>
            Action
        </th>
    </thead>
    <tbody>

        {{-- @dump($user) --}}
 <tr>
    <td>
        {{$user["id"]  }}
    </td>
    <td>
        {{$user["name"]  }}
    </td>
    <td>
        {{$user["email"]  }}
    </td>
    <td>
      <a href="{{route('users.index') }}"><button class="btn btn-success">Back</button> </a>
        <form action="{{ route('users.edit',$user["id"]) }}" method="get">
        <button class="btn btn-primary">Edit</button>
    </form>

<form action="{{ route('users.destroy',$user["id"] ) }}" method="post">
    @csrf
    @method('delete')

            <button class="btn btn-danger">Delete</button>

</form>
    </td>
 </tr>


    </tbody>

</table>
<hr>

<h2 class="text-center text-success"> All Orders </h2>


<table class="table table-striped w-75 m-auto">
    <thead>
        <th>
            Order id
        </th>
        <th>
            Date
        </th>
        <th>
            Products
        </th>
        <th>
            Items
        </th>
        <th>
            Total
        </th>
    </thead>
    <tbody>
        @forelse($user->orders as $order)
 <tr>
    <td>
        {{ $order->id }}
    </td>
    <td>
        {{ $order->created_at->format('Y-m-d') }}
    </td>
    <td>
        <ul class="mb-0">
            @foreach($order->order_items as $item)
            <li>{{ $item->product->name }} x {{ $item->quantity }}</li>
            @endforeach
        </ul>
    </td>
    <td>
        {{ $order->order_items->sum('quantity') }}
    </td>
    <td>
        {{ number_format($order->order_items->sum(fn($item) => $item->price * $item->quantity), 2) }}
    </td>
 </tr>

        @empty
 <tr>
    <td colspan="5" class="text-center"> No orders for this user </td>
 </tr>
        @endforelse
    </tbody>
</table>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</body>
</html>
