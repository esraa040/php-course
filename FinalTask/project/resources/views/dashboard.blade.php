@extends('layouts.app')

@section('title', 'Control center')
@section('eyebrow', 'Admin area')
@section('heading', 'Control center')
@section('lede', 'Everything happening across your store, in one place.')

@section('actions')
    <a href="{{ route('products.index') }}" class="btn btn-primary">View products</a>
@endsection

@section('content')
    <section class="stat-grid">
        <article class="stat-card">
            <span class="stat-label">Users</span>
            <strong class="stat-num">{{ number_format($userCount) }}</strong>
            <a class="stat-link" href="{{ route('users.index') }}">Manage users &rarr;</a>
        </article>
        <article class="stat-card g">
            <span class="stat-label">Categories</span>
            <strong class="stat-num">{{ number_format($categoryCount) }}</strong>
            <a class="stat-link" href="{{ route('categories.index') }}">Manage categories &rarr;</a>
        </article>
        <article class="stat-card a">
            <span class="stat-label">Products</span>
            <strong class="stat-num">{{ number_format($productCount) }}</strong>
            <a class="stat-link" href="{{ route('products.index') }}">Manage products &rarr;</a>
        </article>
        <article class="stat-card b">
            <span class="stat-label">Orders</span>
            <strong class="stat-num">{{ number_format($orderCount) }}</strong>
            <a class="stat-link" href="{{ route('orders.index') }}">Manage orders &rarr;</a>
        </article>
        <article class="stat-card r">
            <span class="stat-label">Revenue</span>
            <strong class="stat-num">${{ number_format((float) $revenue, 2) }}</strong>
            <a class="stat-link" href="{{ route('payments.index') }}">Manage payments &rarr;</a>
        </article>
    </section>

    <div class="two-col">
        <div class="stack">
            <section class="card">
                <div class="card-head">
                    <h2>Users</h2>
                    <a class="stat-link" href="{{ route('users.index') }}">All users &rarr;</a>
                </div>
                <div class="tbl-wrap">
                    <table class="tbl">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td><strong>{{ $user->name }}</strong></td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge {{ $user->role === 'admin' ? 'badge-purple' : 'badge-gray' }}">{{ $user->role }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="empty">No users yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="card">
                <div class="card-head">
                    <h2>Latest payments</h2>
                    <a class="stat-link" href="{{ route('payments.index') }}">All payments &rarr;</a>
                </div>
                <div class="tbl-wrap">
                    <table class="tbl">
                        <thead>
                            <tr>
                                <th>Reference</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentPayments as $payment)
                                <tr>
                                    <td>#PAY-{{ str_pad($payment->id, 5, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $payment->order?->user?->name ?? '-' }}</td>
                                    <td><strong>${{ number_format($payment->amount, 2) }}</strong></td>
                                    <td>
                                        <span class="badge {{ $payment->status === 'paid' ? 'badge-green' : ($payment->status === 'refunded' ? 'badge-red' : 'badge-amber') }}">{{ $payment->status }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="empty">No payments have been recorded yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>

        <div class="stack">
            <section class="card">
                <div class="card-head">
                    <h2>Categories</h2>
                    <span class="muted">Products</span>
                </div>
                <div class="tbl-wrap">
                    <table class="tbl">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Products</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categoryStats as $category)
                                <tr>
                                    <td><strong>{{ $category->name }}</strong></td>
                                    <td><span class="badge badge-purple">{{ $category->products_count }}</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="empty">No categories yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="card">
                <div class="card-head">
                    <h2>Stock watch</h2>
                    <span class="muted">5 units or less</span>
                </div>
                @forelse ($lowStockProducts as $product)
                    <div class="meter-row">
                        <div class="meter-top">
                            <span>{{ $product->name }}</span>
                            <strong>{{ $product->quantity }}</strong>
                        </div>
                        <div class="meter">
                            <i style="width: {{ min(100, max(8, $product->quantity * 20)) }}%"></i>
                        </div>
                    </div>
                @empty
                    <div class="empty">Everything is comfortably stocked.</div>
                @endforelse
            </section>

            <section class="card">
                <div class="card-head">
                    <h2>Inventory value</h2>
                </div>
                <div class="card-pad">
                    <strong class="stat-num">${{ number_format((float) $inventoryValue, 2) }}</strong>
                    <span class="muted">Current stock at listed price</span>
                </div>
            </section>
        </div>
    </div>
@endsection
