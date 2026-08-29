@extends('layouts.app')

@section('title', 'Add order')
@section('eyebrow', 'Administration')
@section('heading', 'Add order')
@section('lede', 'Open a new order for a customer.')

@section('actions')
    <a href="{{ route('orders.index') }}" class="btn btn-ghost">Back to orders</a>
@endsection

@section('content')
    <section class="card form-card">
        <form class="card-pad" action="{{ route('orders.store') }}" method="post">
            @csrf

            <div class="field">
                <label for="user_id">Customer</label>
                <select name="user_id" id="user_id">
                    @foreach ($users as $row)
                        <option value="{{ $row->id }}" @selected(old('user_id') == $row->id)>{{ $row->name }} ({{ $row->email }})</option>
                    @endforeach
                </select>
                @error('user_id')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Create order</button>
                <a href="{{ route('orders.index') }}" class="btn btn-ghost">Cancel</a>
            </div>
        </form>
    </section>
@endsection
