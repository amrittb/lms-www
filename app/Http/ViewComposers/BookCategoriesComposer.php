<?php namespace App\Http\ViewComposers;

use App\Models\BookCategory;
use Illuminate\View\View;

class BookCategoriesComposer {

    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view) {
        $view->with('categories',BookCategory::all());
    }
}