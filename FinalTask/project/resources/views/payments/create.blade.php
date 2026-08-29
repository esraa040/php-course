@extends('layouts.app')

@section('title', 'Add payment')
@section('eyebrow', 'Administration')
@section('heading', 'Add payment')
@section('lede', 'Record a payment against an existing order.')

@section('actions')
    <a href="{{ route('payments.index') }}" class="btn btn-ghost">Back to payments</a>
@endsection

@section('content')
    <section class="card form-card">
        <form class="card-pad" action="{{ route('payments.store') }}" method="post">
            @csrf

            <div class="field">
                <label for="order_id">Order</label>
                <select name="order_id" id="order_id">
                    @foreach ($orders as $row)
                        <option value="{{ $row->id }}" @selected(old('order_id') == $row->id)>#{{ $row->id }} - {{ $row->user?->name }}</option>
                    @endforeach
                </select>
                @error('order_id')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="amount">Amount</label>
                <input type="number" step="0.01" name="amount" id="amount" value="{{ old('amount') }}">
                @error('amount')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="method">Method</label>
                <select name="method" id="method">
                    @foreach (['cash', 'card', 'wallet'] as $method)
                        <option value="{{ $method }}" @selected(old('method') == $method)>{{ $method }}</option>
                    @endforeach
                </select>
                @error('method')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="status">Status</label>
                <select name="status" id="status">
                    @foreach (['pending', 'paid', 'refunded'] as $status)
                        <option value="{{ $status }}" @selected(old('status') == $status)>{{ $status }}</option>
                    @endforeach
                </select>
                @error('status')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="paid_at">Paid at <span class="hint">(optional)</span></label>
                <input type="datetime-local" name="paid_at" id="paid_at" value="{{ old('paid_at') }}">
                @error('paid_at')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Create payment</button>
                <a href="{{ route('payments.index') }}" class="btn btn-ghost">Cancel</a>
            </div>
        </form>
    </section>
@endsection
