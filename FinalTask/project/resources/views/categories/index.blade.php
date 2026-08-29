@extends('layouts.app')

@section('title', 'Categories')
@section('eyebrow', 'Administration')
@section('heading', 'Categories')
@section('lede', 'Organize products into clear groups.')

@section('actions')
    <a href="{{ route('categories.create') }}" class="btn btn-primary">Add category</a>
@endsection

@section('content')
    <section class="card">
        <div class="tbl-wrap">
            <table class="tbl">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td><strong>{{ $category->name }}</strong></td>
                            <td>{{ $category->description }}</td>
                            <td>
                                <div class="row-actions">
                                    <a href="{{ route('categories.show', $category->id) }}" class="btn btn-view btn-sm">View</a>
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-edit btn-sm">Edit</a>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="empty">No categories yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
