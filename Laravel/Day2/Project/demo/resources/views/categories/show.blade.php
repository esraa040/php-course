<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <title>Category</title>
</head>
<body>

<h1 style="text-align: center;color:red"> Category Details </h1>


<table class="table table-striped w-75 m-auto">
    <thead>
        <th>
            id
        </th>
        <th>
            Name
        </th>
        <th>
            Description
        </th>
        <th>
            Action
        </th>
    </thead>
    <tbody>
 <tr>
    <td>
        {{ $category->id }}
    </td>
    <td>
        {{ $category->name }}
    </td>
    <td>
        {{ $category->description }}
    </td>
    <td>
        <a href="{{ route('categories.index') }}"><button class="btn btn-success">Back</button></a>
    </td>
 </tr>
    </tbody>

</table>
<hr>

<h2 class="text-center text-success"> Products in this category </h2>

<table class="table table-striped w-75 m-auto">
    <thead>
        <th>
            id
        </th>
        <th>
            Name
        </th>
        <th>
            Price
        </th>
        <th>
            Quantity
        </th>
        <th>
            Action
        </th>
    </thead>
    <tbody>
        @foreach($category->products as $product)
 <tr>
    <td>
        {{ $product->id }}
    </td>
    <td>
        {{ $product->name }}
    </td>
    <td>
        {{ $product->price }}
    </td>
    <td>
        {{ $product->quantity }}
    </td>
    <td>
        <a href="{{ route('products.show',$product->id) }}"><button class="btn btn-warning">View</button></a>
    </td>
 </tr>

        @endforeach
    </tbody>

</table>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</body>
</html>
