<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProvisionCategory extends Model {

    /**
     * Setting time stamps to false
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
        'category_name'
    ];

    /**
     * Defines a relationship with BookCopy Model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookCopies() {
        return $this->hasMany('App\Models\BookCopy','provision_category_id');
    }
}
