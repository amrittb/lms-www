<?php namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\SaveBookRequest;
use App\Models\Publication;

class BooksController extends Controller {

    /**
     * Lists all the books
     *
     * @return mixed
     */
    public function index() {
        $books = Book::with('publication')->paginate(20);

        return view('books.index',compact('books'));
    }

    /**
     * Shows a form to create a book.
     *
     * @return mixed
     */
    public function create() {
        return view('books.create');
    }

    /**
     * Stores a book to the database
     *
     * @param SaveBookRequest $request
     */
    public function store(SaveBookRequest $request) {
        $publication = Publication::findOrFail($request->input('publication_id'));

        $publication->books()->create([
            'book_name' => $request->input('book_name'),
            'isbn' => $request->input('isbn'),
            'edition' => $request->input('edition')
        ]);

        return redirect()->route('books.index')->with('message','The Book has been created');
    }
}
