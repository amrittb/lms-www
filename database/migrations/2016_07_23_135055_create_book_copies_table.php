<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateBookCopiesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::statement("CREATE TABLE `book_copies`(
                  `copy_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                  `book_id` INT(10) UNSIGNED NOT NULL,
                  PRIMARY KEY (`copy_id`,`book_id`),
                  FOREIGN KEY (`book_id`) REFERENCES books(`id`)
                  ON DELETE CASCADE
          )");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::statement('DROP TABLE book_copies');
    }
}
