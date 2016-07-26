<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class BookCopiesController extends Controller {

    /**
     * Store a book copy for the book
     *
     * @param $bookId
     * @param Request $request
     * @return mixed
     */
    public function store($bookId,Request $request){
        DB::insert("INSERT INTO book_copies VALUES(:copy_id,:book_id,0,:provider_id,:provision_category_id)",[
            'copy_id' => $request->input('copy_id'),
            'book_id' => $bookId,
            'provider_id' => $request->input('provider_id'),
            'provision_category_id' => $request->input('provision_category_id'),
        ]);

        return redirect()->back()->with('message','Book Copy added successfully');
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
