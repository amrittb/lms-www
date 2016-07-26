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
        DB::insert("INSERT INTO provision_categories VALUES(NULL,:category_name)",[
            'category_name' => $request->input('category_name')
        ]);

        return redirect()->back()->with('message','Provision Category added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $provisionCategory = DB::selectOne("SELECT * FROM provision_categories WHERE id = :id",compact('id'));

        return view('books.provisioncategories.edit',compact('provisionCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SaveProvisionCategoryRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveProvisionCategoryRequest $request, $id) {
        DB::update("UPDATE provision_categories SET category_name = :category_name WHERE id = :id",[
            'category_name' => $request->input('category_name'),
            'id' => $id
        ]);

        return redirect()->route('provisioncategories.index')->with('message','Provision Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        DB::delete("DELETE FROM provision_categories WHERE id = :id",compact('id'));

        return redirect()->back()->with('message','Provision Category deleted successfully');
    }
}
