<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
        </li>
       <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('users.index') }}">Users</a>
        </li>
       <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('categories.index') }}">Categories</a>
        </li>
       <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('products.index') }}">Products</a>
        </li>
       <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('orders.index') }}">Orders</a>
        </li>
       <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('order_items.index') }}">Order Items</a>
        </li>

        @guest
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('login') }}">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('register') }}">Register</a>
        </li>
        @endguest
        @auth
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('users.show', auth()->id()) }}">{{ auth()->user()->name }}</a>
        </li>
        <li class="nav-item">
          <form action="{{ route('logout') }}" method="post">
            @csrf
            <button class="btn btn-link nav-link">Logout</button>
          </form>
        </li>
        @endauth
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
