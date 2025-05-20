{{-- filepath: c:\Users\samiu\Herd\book-store\resources\views\books\edit.blade.php --}}
@extends('layout')

@section('content')
    <h1 class="mb-4">Edit Book</h1>
    <form action="{{ route('books.update', $book) }}" method="POST" class="row g-3">
        @csrf
        @method('PUT')
        <div class="col-md-6">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $book->title) }}">
            @error('title') <p class="text-danger">{{ $message }}</p> @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Author</label>
            <input type="text" name="author" class="form-control" value="{{ old('author', $book->author) }}">
            @error('author') <p class="text-danger">{{ $message }}</p> @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">ISBN</label>
            <input type="text" name="isbn" class="form-control" value="{{ old('isbn', $book->isbn) }}">
            @error('isbn') <p class="text-danger">{{ $message }}</p> @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Stock</label>
            <input type="number" name="stock" class="form-control" value="{{ old('stock', $book->stock) }}">
            @error('stock') <p class="text-danger">{{ $message }}</p> @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Price</label>
            <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $book->price) }}">
            @error('price') <p class="text-danger">{{ $message }}</p> @enderror
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('books.index') }}" class="btn btn-danger">Back</a>
        </div>
    </form>
@endsection