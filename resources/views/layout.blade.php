{{-- filepath: c:\Users\samiu\Herd\book-store\resources\views\layout.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <title>Book Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-dark text-white p-3">
        <div class="container">
            <h1 class="h3">Bookstore</h1>
            <nav>
                <a href="{{ route('books.index') }}" class="text-white text-decoration-none">Books</a>
            </nav>
        </div>
    </header>
    <main class="container my-4">
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>