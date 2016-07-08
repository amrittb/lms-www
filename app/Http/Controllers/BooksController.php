<?php namespace App\Http\Controllers;

use App\Models\Book;

class BooksController extends Controller {

    public function index() {
        $books = Book::with('publication')->paginate(20);

        return view('books.index',compact('books'));
    }
}
