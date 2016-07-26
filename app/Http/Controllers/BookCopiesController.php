<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveBookCopyRequest;

class BookCopiesController extends Controller {

    /**
     * Store a book copy for the book
     *
     * @param $bookId
     * @param SaveBookCopyRequest $request
     * @return mixed
     */
    public function store($bookId,SaveBookCopyRequest $request){
        DB::insert("INSERT INTO book_copies VALUES(:copy_id,:book_id,0,:provider_id,:provision_category_id)",[
            'copy_id' => $request->input('copy_id'),
            'book_id' => $bookId,
            'provider_id' => $request->input('provider_id'),
            'provision_category_id' => $request->input('provision_category_id'),
        ]);

        return redirect()->back()->with('message','Book Copy added successfully');
    }

    /**
     * Shows a edit page to edit book copy
     *
     * @param $bookId
     * @param $copyId
     * @return mixed
     */
    public function edit($bookId,$copyId) {
        $bookCopy = DB::selectOne("SELECT book_copies.book_id,
                                          book_copies.copy_id,
                                          book_copies.provider_id,
                                          book_copies.provision_category_id,
                                          books.book_name
                                    FROM book_copies 
                                    JOIN books ON books.id = book_copies.book_id
                                    WHERE book_id = :book_id 
                                    AND copy_id = :copy_id",[
            'book_id' => $bookId,
            'copy_id' => $copyId
        ]);

        return view('books.copies.edit',compact('bookCopy'));
    }

    /**
     * Updates a book copy entry
     *
     * @param $bookId
     * @param $copyId
     * @param SaveBookCopyRequest $request
     * @return mixed
     */
    public function update($bookId,$copyId,SaveBookCopyRequest $request) {
        DB::update("UPDATE book_copies SET provider_id = :provider_id, provision_category_id = :provision_category_id WHERE book_id = :book_id AND copy_id = :copy_id",[
            'provider_id' => intval($request->input('provider_id')),
            'provision_category_id' => intval($request->input('provision_category_id')),
            'book_id' => $bookId,
            'copy_id' => $copyId
        ]);

        return redirect()->back()->with('message','Book Copy updated successfully');
    }

    /**
     * Deletes a book copy
     *
     * @param $bookId
     * @param $copyId
     * @return mixed
     */
    public function destroy($bookId,$copyId) {
        DB::delete("DELETE FROM book_copies
                    WHERE book_copies.book_id = :book_id 
                    AND book_copies.copy_id = :copy_id", [
            'book_id' => $bookId,
            'copy_id' => $copyId
        ]);

        return redirect()->back()->with('message','Book Copy deleted successfully');
    }
}
