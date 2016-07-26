<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveBookCategoryRequest;

class BookCategoriesController extends Controller {

    /**
     * Shows a list of book categories
     */
    public function index() {
        $categories = DB::select('SELECT * FROM book_categories');

        return view('books.categories.index',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SaveBookCategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveBookCategoryRequest $request) {
        DB::insert("INSERT INTO book_categories VALUES(NULL,:category_name)",[
            'category_name' => $request->input('category_name')
        ]);

        return redirect()->back()->with('message','Book Category added successfully');
    }

    /**
     * Shows a edit page for updating book category
     *
     * @param $id
     * @return mixed
     */
    public function edit($id) {
        $category = DB::selectOne("SELECT * FROM book_categories WHERE id = :id",compact('id'));

        return view('books.categories.edit',compact('category'));
    }

    /**
     * Updates a book category
     *
     * @param $id
     * @param SaveBookCategoryRequest $request
     */
    public function update($id,SaveBookCategoryRequest $request) {
        DB::update("UPDATE book_categories SET book_categories.category_name = :category_name WHERE id = :id",[
            'category_name' => $request->input('category_name'),
            'id' => $id
        ]);

        return redirect()->back()->with('message','Book Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        DB::delete('DELETE FROM book_categories WHERE book_categories.id = :category_id',[
            'category_id' => $id
        ]);

        return redirect()->back()->with('message','Book category deleted successfully');
    }
}
