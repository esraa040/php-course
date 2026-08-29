@extends('layouts.app')

@section('title', 'Payments')
@section('eyebrow', 'Administration')
@section('heading', 'Payments')
@section('lede', 'Track what has been collected, what is pending and what was refunded.')

@section('actions')
    <a href="{{ route('payments.create') }}" class="btn btn-primary">Add payment</a>
@endsection

@section('content')
    <section class="card">
        <div class="tbl-wrap">
            <table class="tbl">
                <thead>
                    <tr>
                        <th>Reference</th>
                        <th>Order</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($payments as $payment)
                        <tr>
                            <td>#PAY-{{ str_pad($payment->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td><a class="stat-link" href="{{ route('orders.show', $payment->order_id) }}">#{{ $payment->order_id }}</a></td>
                            <td>{{ $payment->order?->user?->name ?? '-' }}</td>
                            <td><strong>${{ number_format($payment->amount, 2) }}</strong></td>
                            <td>{{ $payment->method }}</td>
                            <td>
                                <span class="badge {{ $payment->status === 'paid' ? 'badge-green' : ($payment->status === 'refunded' ? 'badge-red' : 'badge-amber') }}">{{ $payment->status }}</span>
                            </td>
                            <td>
                                <div class="row-actions">
                                    <a href="{{ route('payments.show', $payment->id) }}" class="btn btn-view btn-sm">View</a>
                                    <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-edit btn-sm">Edit</a>
                                    <form action="{{ route('payments.destroy', $payment->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="empty">No payments have been recorded yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
