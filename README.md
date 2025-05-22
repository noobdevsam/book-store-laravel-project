# Book Store Laravel Application

A simple Book Store web application built with Laravel and Bootstrap. This project allows users to manage a collection of books, including features for listing, searching, creating, updating, viewing, and deleting books. The UI is styled with Bootstrap 5 for a modern and responsive experience.

---

## 📺 Demo Video

<div align="center">
  
[![Book Store Laravel Demo](https://github.com/noobdevsam/book-store-laravel-project/blob/master/resources/Screenshot2025-05-22.png)](https://youtu.be/MxATPW3Ew_E?feature=shared)

</div>

> _Click the image above to watch the demo on YouTube!_


---

## Features

- List all books with pagination
- Search books by title or author
- Add new books (with title, author, ISBN, stock, and price)
- Edit existing book details
- View detailed information for each book
- Delete books
- Responsive and clean Bootstrap 5 UI

## Implementation Details

### Book Model
Located at `app/Models/Book.php`:
```php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'author', 'isbn', 'stock', 'price',
    ];
}
```

### Book Controller
Located at `app/Http/Controllers/BookController.php` (example methods):
```php
namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $books = Book::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%")
                         ->orWhere('author', 'like', "%{$search}%");
        })->paginate(50);
        return view('books.index', compact('books'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
        ]);
        Book::create($validated);
        return redirect()->route('books.index')->with('success', 'Book created successfully!');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
        ]);
        $book->update($validated);
        return redirect()->route('books.index')->with('success', 'Book updated successfully!');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
    }
}
```

### Migration Example
Located at `database/migrations/2025_05_12_114522_create_books_table.php`:
```php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('isbn');
            $table->integer('stock');
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
};
```

### Blade View Example
Located at `resources/views/books/index.blade.php`:
```blade
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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
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
```

### Routing
Located at `routes/web.php`:
```php
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('books', BookController::class);
```

## Getting Started

### Prerequisites
- PHP >= 8.1
- Composer
- SQLite/MySQL/PostgreSQL (default: SQLite)
- Node.js & npm (for frontend assets, optional)

### Installation

1. **Clone the repository:**
   ```sh
   git clone https://github.com/yourusername/book-store.git
   cd book-store
   ```
2. **Install PHP dependencies:**
   ```sh
   composer install
   ```
3. **Copy and configure environment file:**
   ```sh
   cp .env.example .env
   # Edit .env as needed (DB settings, etc.)
   ```
4. **Generate application key:**
   ```sh
   php artisan key:generate
   ```
5. **Run migrations and seeders:**
   ```sh
   php artisan migrate --seed
   ```
6. **(Optional) Install frontend dependencies:**
   ```sh
   npm install && npm run build
   ```
7. **Start the development server:**
   ```sh
   php artisan serve
   ```
8. **Visit the app:**
   Open [http://localhost:8000/books](http://localhost:8000/books) in your browser.

## Project Structure

- `app/Models/Book.php` - Book Eloquent model
- `app/Http/Controllers/BookController.php` - Controller for book CRUD
- `resources/views/books/` - Blade templates for book pages
- `routes/web.php` - Web routes
- `database/migrations/` - Database schema
- `database/seeders/` - Seeders for sample data

## License

This project is open source and available under the [MIT License](LICENSE).