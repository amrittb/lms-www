<?php namespace App\Http\Controllers;

use App\Http\Requests\SaveBookRequest;
use App\Models\Publication;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BooksController extends Controller {

    /**
     * Lists all the books
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request) {
        $books = DB::select("SELECT books.id,
                                    books.book_name,
                                    books.isbn,
                                    books.edition,
                                    books.created_at,
                                    books.publication_id,
                                    publications.publication_name 
                                FROM books 
                                JOIN publications ON publications.id = books.publication_id 
                                ORDER BY created_at DESC");

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
        $sql = "INSERT INTO books VALUES (NULL,:book_name,:isbn,:edition,:publication_id,:created_at,:updated_at)";

        DB::insert($sql,[
            'book_name' => $request->input('book_name'),
            'isbn' => $request->input('isbn'),
            'edition' => $request->input('edition'),
            'publication_id' => $request->input('publication_id'),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        return redirect()->route('books.index')->with('message','The Book has been created');
    }
}
