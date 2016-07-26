<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider {

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate) {
        $this->registerPolicies($gate);

        $this->registerAbilities($gate);
    }

    /**
     * Registers various abilities
     *
     * @param $gate
     */
    private function registerAbilities($gate) {
        $gate->define('save-book',function(User $user) {
           return $user->isLibrarian();
        });

        $gate->define('delete-book',function(User $user) {
            return $user->isLibrarian();
        });

        $gate->define('save-book-copy',function(User $user) {
            return $user->isLibrarian();
        });

        $gate->define('delete-book-copy',function(User $user) {
            return $user->isLibrarian();
        });

        $gate->define('save-author',function(User $user) {
            return $user->isLibrarian();
        });

        $gate->define('delete-author',function(User $user) {
            return $user->isLibrarian();
        });

        $gate->define('save-publication',function(User $user) {
            return $user->isLibrarian();
        });

        $gate->define('delete-publication',function(User $user) {
            return $user->isLibrarian();
        });

        $gate->define('save-book-category',function(User $user) {
            return $user->isLibrarian();
        });

        $gate->define('delete-book-category',function(User $user) {
            return $user->isLibrarian();
        });

        $gate->define('save-book-provider',function(User $user) {
            return $user->isLibrarian();
        });

        $gate->define('delete-book-provider',function(User $user) {
            return $user->isLibrarian();
        });

        $gate->define('save-provision-category',function(User $user) {
            return $user->isLibrarian();
        });

        $gate->define('delete-provision-category',function(User $user) {
            return $user->isLibrarian();
        });

        $gate->define('issue-book',function(User $user) {
            return $user->isLibrarian();
        });

        $gate->define('create-user',function(User $user) {
            return $user->isAdmin();
        });

        $gate->define('edit-user',function(User $user,$editingUser) {
            return $user->id == $editingUser->id;
        });

        $gate->define('view-user',function(User $user) {
            return ! $user->isMember();
        });

        $gate->define('delete-user',function(User $user) {
            return $user->isAdmin();
        });
    }
}
