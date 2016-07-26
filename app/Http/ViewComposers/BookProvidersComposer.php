<?php namespace App\Http\ViewComposers;

use App\Models\BookProvider;
use Illuminate\View\View;

class BookProvidersComposer {

    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view) {
        $view->with('bookProviders',BookProvider::all());
    }
}