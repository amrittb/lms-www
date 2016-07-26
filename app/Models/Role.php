<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    /**
     * Id for administrator
     */
    const ADMINISTRATOR = 1;

    /**
     * Id for librarian
     */
    const LIBRARIAN = 2;

    /**
     * Id for member
     */
    const MEMBER = 3;

    /**
     * Defines if there are timestamps in the table
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Defines a relationship with User Model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users() {
        return $this->hasMany('App\Models\User');
    }
}
