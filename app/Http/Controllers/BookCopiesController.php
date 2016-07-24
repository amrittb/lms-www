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
        DB::insert("INSERT INTO book_copies VALUES(:copy_id,:book_id)",[
            'copy_id' => $request->input('copy_id'),
            'book_id' => $bookId
        ]);

        return redirect()->back()->with('message','Book Copy added successfully');
    }
}
