@extends('layouts.app')

@section('title', $user->name)
@section('eyebrow', 'Administration')
@section('heading', $user->name)
@section('lede', $user->email)

@section('actions')
    <a href="{{ route('users.index') }}" class="btn btn-ghost">Back to users</a>
    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-edit">Edit</a>
    <form action="{{ route('users.destroy', $user->id) }}" method="post">
        @csrf
        @method('delete')
        <button class="btn btn-danger">Delete</button>
    </form>
@endsection

@section('content')
    <div class="two-col">
        <section class="card">
            <div class="card-head">
                <h2>Orders</h2>
                <span class="muted">{{ $user->orders->count() }}</span>
            </div>
            <div class="tbl-wrap">
                <table class="tbl">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Products</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($user->orders as $order)
                            @php($orderTotal = $order->order_items->sum(fn($item) => $item->price * $item->quantity))
                            <tr>
                                <td><a class="stat-link" href="{{ route('orders.show', $order->id) }}">#{{ $order->id }}</a></td>
                                <td>
                                    @foreach ($order->order_items as $item)
                                        <div>{{ $item->product?->name ?? 'deleted product' }} <span class="muted">x{{ $item->quantity }}</span></div>
                                    @endforeach
                                </td>
                                <td>{{ $order->order_items->sum('quantity') }}</td>
                                <td><strong>${{ number_format($orderTotal, 2) }}</strong></td>
                                <td class="muted">{{ $order->created_at?->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty">This user has no orders yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <section class="card">
            <div class="card-head">
                <h2>Account</h2>
            </div>
            <div class="card-pad">
                <dl class="kv" style="grid-template-columns: 110px 1fr">
                    <dt>User ID</dt>
                    <dd>#{{ $user->id }}</dd>
                    <dt>Name</dt>
                    <dd>{{ $user->name }}</dd>
                    <dt>Email</dt>
                    <dd>{{ $user->email }}</dd>
                    <dt>Role</dt>
                    <dd><span class="badge {{ $user->role === 'admin' ? 'badge-purple' : 'badge-gray' }}">{{ $user->role }}</span></dd>
                    <dt>Joined</dt>
                    <dd>{{ $user->created_at?->format('d M Y') }}</dd>
                </dl>
            </div>
        </section>
    </div>
@endsection
