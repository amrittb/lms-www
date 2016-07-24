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
     * @return mixed
     */
    public function index() {
        $books = DB::select("SELECT books.id,
                                    books.book_name,
                                    books.isbn,
                                    books.edition,
                                    books.created_at,
                                    books.publication_id,
                                    publications.publication_name,
                                    count(copy_id) as copy_count
                                FROM book_copies
                                JOIN books ON books.id = book_copies.book_id
                                JOIN publications ON publications.id = books.publication_id 
                                GROUP BY book_copies.book_id
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
     * Edits a book entry
     *
     * @param $bookId
     * @return mixed
     */
    public function edit($bookId) {
        $book = $this->findBookFromId($bookId);

        return view('books.edit',compact('book'));
    }

    /**
     * Stores a book to the database
     *
     * @param SaveBookRequest $request
     */
    public function store(SaveBookRequest $request) {
        $input = $this->resolveBookInput($request);

        $book = array_merge($input,[
           'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::insert("INSERT INTO books VALUES (
                NULL,
                :book_name,
                :isbn,
                :edition,
                :publication_id,
                :created_at,
                :updated_at)",
        $book);

        return redirect()->route('books.index')->with('message','The Book has been created');
    }

    /**
     * Updates a book
     *
     * @param $bookId
     * @param SaveBookRequest $request
     * @return mixed
     */
    public function update($bookId,SaveBookRequest $request) {
        $input = $this->resolveBookInput($request);

        $book = array_merge($input,[
           'id' => $bookId,
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        DB::update("UPDATE books SET 
                    books.book_name = :book_name,
                    books.isbn = :isbn,
                    books.edition = :edition,
                    books.publication_id = :publication_id,
                    books.updated_at = :updated_at
                    WHERE books.id = :id",
        $book);

        return redirect()->back()->with('message','Book has been successfully updaed');
    }

    /**
     * Deletes a book entry
     *
     * @param $bookId
     * @return mixed
     */
    public function destroy($bookId) {
        DB::delete("DELETE FROM books WHERE books.id = :book_id",['book_id' => $bookId]);

        return redirect()->back()->with('message','Book entry deleted successfully');
    }

    /**
     * Fetches book from book id
     *
     * @param $bookId
     * @return mixed
     */
    protected function findBookFromId($bookId) {
        $book = DB::selectOne("SELECT * FROM books WHERE books.id = :book_id", [
            'book_id' => intval($bookId)
        ]);

        return $book;
    }

    /**
     * Resolves book input from request
     *
     * @param SaveBookRequest|Request $request
     * @return array
     */
    protected function resolveBookInput(Request $request) {
        return [
            'book_name' => $request->input('book_name'),
            'isbn' => $request->input('isbn'),
            'edition' => $request->input('edition'),
            'publication_id' => $request->input('publication_id'),
        ];
    }
}
