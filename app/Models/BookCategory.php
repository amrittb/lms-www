<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model {

    /**
     * Setting timestamps to false
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Fillables array
     * 
     * @var array
     */
    public $fillable = [
        'category_name',
        'parent_category_id'
    ];

    /**
     * Defines a relationship with itself
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parentCategory() {
        return $this->belongsTo('App\Models\BookCategory','parent_id');
    }
}
