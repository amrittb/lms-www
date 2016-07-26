<?php namespace App\Http\Controllers;

use App\Http\Requests\SaveBookRequest;
use App\Models\Publication;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BooksController extends Controller {

    /**
     * Lists all the books
     *
     * @return mixed
     */
    public function index() {
        $books = collect(DB::select("SELECT books.id,
                                    books.book_name,
                                    books.isbn,
                                    books.edition,
                                    books.created_at,
                                    books.publication_id,
                                    publications.publication_name,
                                    book_categories.category_name,
                                    count(copy_id) as copy_count
                                FROM books
                                LEFT JOIN book_copies ON books.id = book_copies.book_id
                                JOIN publications ON publications.id = books.publication_id 
                                JOIN book_categories ON book_categories.id = books.category_id
                                GROUP BY book_copies.book_id
                                ORDER BY created_at DESC"));

        $bookIds = $books->map(function($item){
            return $item->id;
        });

        $authors = collect(DB::select("SELECT author_book.book_id,
                                      authors.id,
                                      authors.name
                                FROM author_book
                                JOIN authors ON authors.id = author_book.author_id
                                WHERE author_book.book_id IN (".join(',',$bookIds->toArray()).")"));

        $books->each(function($book,$key) use ($authors) {
            $book->authors = $authors->filter(function($author,$key) use ($book){
               return $book->id == $author->book_id;
           });
        });

        return view('books.index',compact('books'));
    }

    /**
     * Shows a book entry
     *
     * @param $bookId
     * @return mixed
     */
    public function show($bookId) {
        $book = $this->findBookFromId($bookId);

        $book->copies = $this->getBookCopiesForBook($bookId);

        return view('books.show',compact('book'));
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

//        DB::insert("INSERT INTO books VALUES (
//                NULL,
//                :book_name,
//                :isbn,
//                :edition,
//                :publication_id,
//                :created_at,
//                :updated_at,
//                :category_id
//          )",
//        $book);

        $bookId = DB::table('books')->insertGetId($book);

        $this->syncBookAuthors($bookId,$request->input('author_ids'));

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
                    books.category_id = :category_id,
                    books.updated_at = :updated_at
                    WHERE books.id = :id",
        $book);

        $this->syncBookAuthors($bookId,$request->input('author_ids'));

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
        $book = DB::selectOne("SELECT books.id,
                                      books.book_name,
                                      books.isbn,
                                      books.edition,
                                      books.publication_id,
                                      publications.publication_name,
                                      books.category_id,
                                      book_categories.category_name
                              FROM books 
                              JOIN publications ON publications.id = books.publication_id
                              JOIN book_categories ON book_categories.id = books.category_id
                              WHERE books.id = :book_id", [
            'book_id' => intval($bookId)
        ]);

        if(!$book) {
            throw new ModelNotFoundException();
        }

        $book->authors = collect(DB::select("SELECT authors.id,
                                            authors.name
                                    FROM author_book
                                    JOIN authors ON authors.id = author_book.author_id
                                    WHERE author_book.book_id = :book_id",[
            'book_id' => $bookId
        ]));

        return $book;
    }

    /**
     * Returns Book Copies for a book
     *
     * @param $bookId
     * @return mixed
     */
    public function getBookCopiesForBook($bookId) {
        return DB::select("SELECT book_copies.copy_id, 
                                    book_copies.is_issued,
                                    book_copies.provider_id,
                                    book_providers.provider_name,
                                    book_copies.provision_category_id,
                                    provision_categories.category_name as provision_category_name
                            FROM book_copies 
                            LEFT JOIN book_providers ON book_providers.id = book_copies.provider_id
                            LEFT JOIN provision_categories ON provision_categories.id = book_copies.provision_category_id
                            WHERE book_copies.book_id = :book_id",[
            'book_id' => intval($bookId)
        ]);
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
            'category_id' => $request->input('category_id')
        ];
    }

    /**
     * Syncs Book Authors
     *
     * @param $bookId
     * @param $author_ids
     */
    private function syncBookAuthors($bookId, $author_ids) {
        DB::delete("DELETE FROM author_book WHERE author_book.book_id = :book_id",[
            'book_id' => $bookId
        ]);

        $sql = "INSERT INTO author_book VALUES";

        $insertions = [];

        foreach($author_ids as $id) {
            array_push($insertions,"({$id},{$bookId})");
        }

        $sql .= join(", ",$insertions);

        DB::insert($sql);
    }
}
