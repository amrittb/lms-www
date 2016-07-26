<?php namespace App\Http\ViewComposers;

use App\Models\ProvisionCategory;
use Illuminate\View\View;

class ProvisionCategoriesComposer {

    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view) {
        $view->with('provisionCategories',ProvisionCategory::all());
    }
}