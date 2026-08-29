@extends('layouts.app')

@section('title', 'Edit user')
@section('eyebrow', 'Administration')
@section('heading', 'Edit user')

@section('actions')
    <a href="{{ route('users.index') }}" class="btn btn-ghost">Back to users</a>
@endsection

@section('content')
    <section class="card form-card">
        <form class="card-pad" action="{{ route('users.update', $user->id) }}" method="post">
            @csrf
            @method('put')

            <div class="field">
                <label for="name">Full name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}">
                @error('name')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}">
                @error('email')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="role">Role</label>
                <select name="role" id="role">
                    <option value="user" @selected(old('role', $user->role) == 'user')>user</option>
                    <option value="admin" @selected(old('role', $user->role) == 'admin')>admin</option>
                </select>
                @error('role')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="password">New password <span class="hint">(leave empty to keep the current one)</span></label>
                <input type="password" name="password" id="password">
                @error('password')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="password_confirmation">Confirm new password</label>
                <input type="password" name="password_confirmation" id="password_confirmation">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <a href="{{ route('users.index') }}" class="btn btn-ghost">Cancel</a>
            </div>
        </form>
    </section>
@endsection
