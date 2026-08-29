@extends('layouts.app')

@section('title', 'Edit category')
@section('eyebrow', 'Administration')
@section('heading', 'Edit category')

@section('actions')
    <a href="{{ route('categories.index') }}" class="btn btn-ghost">Back to categories</a>
@endsection

@section('content')
    <section class="card form-card">
        <form class="card-pad" action="{{ route('categories.update', $category->id) }}" method="post">
            @csrf
            @method('put')

            <div class="field">
                <label for="name">Category name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}">
                @error('name')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="3">{{ old('description', $category->description) }}</textarea>
                @error('description')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <a href="{{ route('categories.index') }}" class="btn btn-ghost">Cancel</a>
            </div>
        </form>
    </section>
@endsection
