<?php namespace App\Http\ViewComposers;

use App\Models\Role;
use Illuminate\View\View;

class RolesComposer {

    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view) {
        $view->with('roles',Role::all());
    }
}