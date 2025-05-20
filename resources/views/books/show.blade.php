{{-- filepath: c:\Users\samiu\Herd\book-store\resources\views\books\show.blade.php --}}
@extends('layout')

@section('content')
    <h1 class="mb-4">{{ $book->title }}</h1>
    <p><strong>Author:</strong> {{ $book->author }}</p>
    <p><strong>ISBN:</strong> {{ $book->isbn }}</p>
    <p><strong>Stock:</strong> {{ $book->stock }}</p>
    <p><strong>Price:</strong> ${{ $book->price }}</p>
    <a href="{{ route('books.index') }}" class="btn btn-secondary">Back to List</a>
@endsection