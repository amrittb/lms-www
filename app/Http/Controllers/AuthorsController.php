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
        DB::insert("INSERT INTO authors VALUES (NULL,:name)",[
            'name' => $request->input('name')
        ]);

        return redirect()->back()->with('message','Author added successfully');
    }

    /**
     * Shows a form to edit author
     *
     * @param $id
     * @return mixed
     */
    public function edit($id) {
        $author = DB::selectOne("SELECT * FROM authors WHERE id = :id",compact('id'));

        return view('authors.edit',compact('author'));
    }

    /**
     * Updates an author
     *
     * @param $id
     * @param SaveAuthorRequest $request
     */
    public function update($id,SaveAuthorRequest $request) {
        DB::update("UPDATE `authors` SET `name` = :name WHERE `id` = :id",[
            'name' => $request->input('name'),
            'id' => $id
        ]);

        return redirect()->back()->with('message','Author updated successfully');
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
