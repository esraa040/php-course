@extends('layouts.app')

@section('title', 'Users')
@section('eyebrow', 'Administration')
@section('heading', 'Users')
@section('lede', 'Manage accounts and access roles.')

@section('actions')
    <a href="{{ route('users.create') }}" class="btn btn-primary">Add user</a>
@endsection

@section('content')
    <section class="card">
        <div class="tbl-wrap">
            <table class="tbl">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td><strong>{{ $user->name }}</strong></td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge {{ $user->role === 'admin' ? 'badge-purple' : 'badge-gray' }}">{{ $user->role }}</span>
                            </td>
                            <td>
                                <div class="row-actions">
                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-view btn-sm">View</a>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-edit btn-sm">Edit</a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty">No users yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
