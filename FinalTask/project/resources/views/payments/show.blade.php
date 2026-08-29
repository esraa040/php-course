@extends('layouts.app')

@section('title', 'Payment')
@section('eyebrow', 'Administration')
@section('heading', 'Payment #PAY-' . str_pad($payment->id, 5, '0', STR_PAD_LEFT))

@section('actions')
    <a href="{{ route('payments.index') }}" class="btn btn-ghost">Back to payments</a>
    <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-edit">Edit</a>
    <form action="{{ route('payments.destroy', $payment->id) }}" method="post">
        @csrf
        @method('delete')
        <button class="btn btn-danger">Delete</button>
    </form>
@endsection

@section('content')
    <div class="two-col">
        <section class="card">
            <div class="card-head">
                <h2>Order items</h2>
                <span class="muted">Order #{{ $payment->order_id }}</span>
            </div>
            <div class="tbl-wrap">
                <table class="tbl">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payment->order?->order_items ?? [] as $item)
                            <tr>
                                <td><strong>{{ $item->product?->name ?? 'deleted product' }}</strong></td>
                                <td>{{ $item->quantity }}</td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td><strong>${{ number_format($item->price * $item->quantity, 2) }}</strong></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="empty">This order has no items.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <section class="card">
            <div class="card-head">
                <h2>Payment</h2>
                <span class="badge {{ $payment->status === 'paid' ? 'badge-green' : ($payment->status === 'refunded' ? 'badge-red' : 'badge-amber') }}">{{ $payment->status }}</span>
            </div>
            <div class="card-pad">
                <dl class="kv" style="grid-template-columns: 110px 1fr">
                    <dt>Customer</dt>
                    <dd>{{ $payment->order?->user?->name ?? '-' }}</dd>
                    <dt>Amount</dt>
                    <dd><strong>${{ number_format($payment->amount, 2) }}</strong></dd>
                    <dt>Method</dt>
                    <dd>{{ $payment->method }}</dd>
                    <dt>Paid at</dt>
                    <dd>{{ $payment->paid_at?->format('d M Y, H:i') ?? 'not paid yet' }}</dd>
                    <dt>Created</dt>
                    <dd>{{ $payment->created_at?->format('d M Y, H:i') }}</dd>
                </dl>
            </div>
        </section>
    </div>
@endsection
