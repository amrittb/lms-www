<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookProvider extends Model {

    /**
     * Setting timestamps to false
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Fillable columns for this model
     *
     * @var array
     */
    public $fillable = [
        'provider_name',
        'contact_no',
        'contact_pname'
    ];

    /**
     * Defines a relationship with BookCopy Model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookCopies() {
        return $this->hasMany('App\Models\BookCopy','provider_id');
    }
}
