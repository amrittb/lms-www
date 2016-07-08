<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider {

    /**
     * Register bindings in the container.
     */
    public function boot() {
        view()->composer(
            'auth.register', 'App\Http\ViewComposers\RolesComposer'
        );

        view()->composer(
            'partials.books.save', 'App\Http\ViewComposers\PublicationsComposer'
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // TODO: Implement register() method.
    }
}