{{-- filepath: c:\Users\samiu\Herd\book-store\resources\views\books\create.blade.php --}}
@extends('layout')

@section('content')
    <h1 class="mb-4">New Book</h1>
    <form action="{{ route('books.store') }}" method="POST" class="row g-3">
        @csrf
        <div class="col-md-6">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" placeholder="Enter book title" value="{{ old('title') }}">
            @error('title') <p class="text-danger">{{ $message }}</p> @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Author</label>
            <input type="text" name="author" class="form-control" placeholder="Enter author name" value="{{ old('author') }}">
            @error('author') <p class="text-danger">{{ $message }}</p> @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">ISBN</label>
            <input type="text" name="isbn" class="form-control" placeholder="Enter ISBN number" value="{{ old('isbn') }}">
            @error('isbn') <p class="text-danger">{{ $message }}</p> @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Stock</label>
            <input type="number" name="stock" class="form-control" placeholder="Enter stock quantity" value="{{ old('stock') }}">
            @error('stock') <p class="text-danger">{{ $message }}</p> @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Price</label>
            <input type="number" step="0.01" name="price" class="form-control" placeholder="Enter price" value="{{ old('price') }}">
            @error('price') <p class="text-danger">{{ $message }}</p> @enderror
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('books.index') }}" class="btn btn-danger">Back</a>
        </div>
    </form>
@endsection