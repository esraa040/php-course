<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>update order</title>
    <x-bootstrap-css></x-bootstrap-css>
</head>

<body>
    <x-navbar></x-navbar>
    <h1 style="text-align: center;color:red"> Update Order </h1>
    <form class="w-75 m-auto border border-1 p-5" action="{{ route('orders.update',$order["id"]) }}" method="post">
        @csrf
        @method('put')

        <div class="mb-3">
            @error('user_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="user_id" class="form-label">User</label>
            <select class="form-control" name="user_id" id="user_id">
                @foreach($users as $row)
                <option value="{{ $row->id }}" @selected(old('user_id', $order->user_id) == $row->id)>{{ $row->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>

    <x-bootstrap-js></x-bootstrap-js>

</body>

</html>
