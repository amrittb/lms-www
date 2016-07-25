<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveAuthorRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class AuthorsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $authors = DB::select("SELECT * FROM authors");

        return view('authors.index',compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SaveAuthorRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveAuthorRequest $request) {
        DB::insert("INSERT INTO authors VALUES (NULL,:author_name)",[
            'author_name' => $request->input('author_name')
        ]);

        return redirect()->back()->with('message','Author added successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        DB::delete("DELETE FROM authors WHERE authors.id = :id",compact('id'));

        return redirect()->back()->with('message','Author deleted successfully');
    }
}
