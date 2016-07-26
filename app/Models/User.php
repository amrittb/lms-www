<?php namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','middle_name','last_name', 'email', 'password','expires_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Checks if the user is an administrator
     *
     * @return bool
     */
    public function isAdmin() {
        return $this->role_id == Role::ADMINISTRATOR;
    }

    /**
     * Checks if the user is a librarian
     *
     * @return bool
     */
    public function isLibrarian() {
        return $this->role_id == Role::LIBRARIAN;
    }

    /**
     * Checks if the user is a member
     *
     * @return bool
     */
    public function isMember() {
        return $this->role_id == Role::MEMBER;
    }
}
