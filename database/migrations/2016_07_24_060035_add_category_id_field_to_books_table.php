<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryIdFieldToBooksTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::statement('ALTER TABLE books ADD category_id INT(10) UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE books ADD FOREIGN KEY(category_id) REFERENCES book_categories(id)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::statement('ALTER TABLE books DROP COLUMN category_id');
    }
}
