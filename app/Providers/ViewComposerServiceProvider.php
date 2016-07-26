<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider {

    /**
     * Register bindings in the container.
     */
    public function boot() {
        view()->composer(
            'partials.users.save', 'App\Http\ViewComposers\RolesComposer'
        );

        view()->composer(
            'partials.books.save', 'App\Http\ViewComposers\PublicationsComposer'
        );

        view()->composer(
            'partials.books.save','App\Http\ViewComposers\BookCategoriesComposer'
        );

        view()->composer(
            'partials.books.save','App\Http\ViewComposers\AuthorsComposer'
        );

        view()->composer(
            'partials.books.copies.save','App\Http\ViewComposers\BookProvidersComposer'
        );

        view()->composer(
            'partials.books.copies.save','App\Http\ViewComposers\ProvisionCategoriesComposer'
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