@extends('layouts.app')

@section('title', 'Add user')
@section('eyebrow', 'Administration')
@section('heading', 'Add user')
@section('lede', 'Create an account and choose the access role.')

@section('actions')
    <a href="{{ route('users.index') }}" class="btn btn-ghost">Back to users</a>
@endsection

@section('content')
    <section class="card form-card">
        <form class="card-pad" action="{{ route('users.store') }}" method="post">
            @csrf

            <div class="field">
                <label for="name">Full name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}">
                @error('name')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}">
                @error('email')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="role">Role</label>
                <select name="role" id="role">
                    <option value="user" @selected(old('role') == 'user')>user</option>
                    <option value="admin" @selected(old('role') == 'admin')>admin</option>
                </select>
                @error('role')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
                @error('password')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="password_confirmation">Confirm password</label>
                <input type="password" name="password_confirmation" id="password_confirmation">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Create user</button>
                <a href="{{ route('users.index') }}" class="btn btn-ghost">Cancel</a>
            </div>
        </form>
    </section>
@endsection
