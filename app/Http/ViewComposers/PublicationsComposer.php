<?php namespace App\Http\ViewComposers;

use App\Models\Publication;
use Illuminate\View\View;

class PublicationsComposer {

    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view) {
        $view->with('publications',Publication::all());
    }
}