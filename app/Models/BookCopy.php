<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookCopy extends Model {

    /**
     * Primary key for the model
     *
     * @var string
     */
    public $primaryKey = 'copy_id';

    /**
     * Setting no timestamps
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Defines a relationship with Book model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book() {
        return $this->belongsTo('App\Models\Book');
    }
}
