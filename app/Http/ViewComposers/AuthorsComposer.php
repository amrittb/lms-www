<?php namespace App\Http\ViewComposers;

use App\Models\Author;
use Illuminate\View\View;

class AuthorsComposer {

    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view) {
        $view->with('authors',Author::all());
    }
}