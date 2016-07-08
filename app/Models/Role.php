<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

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
