{{-- filepath: c:\Users\samiu\Herd\book-store\resources\views\books\index.blade.php --}}
@extends('layout')

@section('content')
    <h1 class="mb-4">Bookstore</h1>
    <div class="d-flex justify-content-between mb-3">
        <form class="d-flex" method="GET" action="{{ route('books.index') }}">
            <input class="form-control me-2" type="search" placeholder="Search books" name="search">
            <button class="btn btn-primary" type="submit">Search</button>
        </form>
        <a href="{{ route('books.create') }}" class="btn btn-success">New Book</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>ISBN</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->isbn }}</td>
                    <td>${{ number_format($book->price, 2) }}</td>
                    <td>
                        <a href="{{ route('books.show', $book) }}" class="btn btn-info btn-sm">Details</a>
                        <a href="{{ route('books.edit', $book) }}" class="btn btn-warning btn-sm">Update</a>
                        <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $books->links('pagination::bootstrap-5') }}
    </div>
@endsection