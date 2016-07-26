<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller {

    /**
     * Searches books
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request) {
        if( ! ($request->input('q') && $request->input('by'))) {
            return redirect('/');
        }

        $q = $request->input('q');
        $by = $request->input('by');

        $results = [];

        switch ($by) {
            case 'book_id':
                $results = $this->findByBookId($q);
                break;
            case 'isbn':
                $results = $this->findByISBN($q);
                break;
            case 'book_title':
                $results = $this->findByBookTitle($q);
                break;
            default:
                return redirect('/');
        }

        return view('books.index',['books' => $results]);
    }

    /**
     * Finds a book by its id
     *
     * @param $q
     * @return mixed
     */
    private function findByBookId($q) {
        return DB::select("SELECT books.id,
                                      books.book_name,
                                      books.isbn,
                                      books.edition,
                                      books.publication_id,
                                      publications.publication_name,
                                      books.category_id,
                                      book_categories.category_name,
                                      count(book_copies.copy_id) as copy_count
                              FROM books
                              LEFT JOIN book_copies ON books.id = book_copies.book_id
                              JOIN publications ON publications.id = books.publication_id
                              JOIN book_categories ON book_categories.id = books.category_id
                              WHERE books.id = :book_id
                              GROUP BY book_copies.book_id", [
            'book_id' => intval($q)
        ]);
    }

    /**
     * Finds book by ISBN number
     *
     * @param $q
     * @return mixed
     */
    private function findByISBN($q) {
        return DB::select("SELECT books.id,
                                      books.book_name,
                                      books.isbn,
                                      books.edition,
                                      books.publication_id,
                                      publications.publication_name,
                                      books.category_id,
                                      book_categories.category_name,
                                      count(copy_id) as copy_count
                              FROM books 
                              LEFT JOIN book_copies ON books.id = book_copies.book_id
                              JOIN publications ON publications.id = books.publication_id
                              JOIN book_categories ON book_categories.id = books.category_id
                              WHERE books.isbn = :isbn
                              GROUP BY book_copies.book_id", [
            'isbn' => $q
        ]);
    }

    /**
     * Finds Book by book title
     * 
     * @param $q
     * @return mixed
     */
    private function findByBookTitle($q) {
        return DB::select("SELECT books.id,
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
                            WHERE books.book_name LIKE :title
                            GROUP BY book_copies.book_id",[
            'title' => '%'.$q.'%'
        ]);
    }
}
