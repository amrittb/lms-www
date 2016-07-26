<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class PublicationsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $publications = DB::select("SELECT * FROM publications");

        return view('publications.index',compact('publications'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        DB::insert("INSERT INTO publications VALUES(NULL,:publication_name)",[
            'publication_name' => $request->input('publication_name')
        ]);

        return redirect()->back()->with('message','Publication added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $publication = DB::selectOne("SELECT * FROM publications WHERE id = :id",compact('id'));

        return view('publications.edit',compact('publication'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        DB::update("UPDATE publications SET publication_name = :publication_name WHERE id = :id",[
            'publication_name' => $request->input('publication_name'),
            'id' => $id
        ]);

        return redirect()->route('publications.index')->with('message','Publication updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        DB::delete("DELETE FROM publications WHERE id = :id",compact('id'));

        return redirect()->back()->with('message','Publication deleted successfully');
    }
}
