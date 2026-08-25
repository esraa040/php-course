<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>create user</title>
    <x-bootstrap-css></x-bootstrap-css>
</head>

<body>
    <x-navbar></x-navbar>
    <h1 style="text-align: center;color:red"> Create New User </h1>
    <form class="w-75 m-auto border border-1 p-5" action="{{ route('users.store') }}" method="post">
        @csrf

        <div class="mb-3">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="name" class="form-label">User Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
        </div>
        <div class="mb-3">
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
        </div>

        <button type="submit" class="btn btn-success">Create</button>
    </form>

    <x-bootstrap-js></x-bootstrap-js>

</body>

</html>
