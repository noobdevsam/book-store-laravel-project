<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    // List all books
    public function index(Request $request)
{
    $search = $request->input('search');
    $books = Book::when($search, function ($query, $search) {
        return $query->where('title', 'like', "%{$search}%")
                     ->orWhere('author', 'like', "%{$search}%");
    })->paginate(50); // Use paginate() instead of get()

    return view('books.index', compact('books'));
}

    // Show form to create a new book
    public function create()
    {
        return view('books.create');
    }

    // Save a new book
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|max:13|unique:books',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    // Show details of a specific book
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    // Show form to edit an existing book
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    // Update an existing book
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|max:13|unique:books,isbn,' . $book->id,
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        $book->update($validated);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    // Delete a book
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}