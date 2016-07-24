<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model {

    /**
     * Sets no timestamps
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Defines a relationship with Book model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function books() {
        return $this->belongsToMany('App\Models\Book');
    }
}
