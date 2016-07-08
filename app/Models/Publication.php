<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model {

    /**
     * Defines if the model has timestamps
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * Fillable properties for this model.
     *
     * @var array
     */
    public $fillable = [
        'publication_name'
    ];

    /**
     * Defines a relationship with Book Model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books() {
        return $this->hasMany('App\Models\Book');
    }
}
