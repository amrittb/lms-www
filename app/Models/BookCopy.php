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

    /**
     * Defines a relationship with Book Provider Model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function provider() {
        return $this->belongsTo('App\Models\BookProvider','provider_id');
    }

    /**
     * Defines a relationship with ProvisionCategory Model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provisionCategory() {
        return $this->belongsTo('App\Models\ProvisionCategory','provision_category_id');
    }
}
