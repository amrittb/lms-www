<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveProvisionCategoryRequest;

class ProvisionCategoriesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $provisionCategories = DB::select("SELECT * FROM provision_categories");

        return view('books.provisioncategories.index',compact('provisionCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SaveProvisionCategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveProvisionCategoryRequest $request) {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param SaveProvisionCategoryRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveProvisionCategoryRequest $request, $id) {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

    }
}
