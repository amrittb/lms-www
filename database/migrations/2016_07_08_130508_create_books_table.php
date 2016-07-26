<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::statement("CREATE TABLE `books` (
                        `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                        `book_name` VARCHAR (255) NOT NULL,
                        `isbn` VARCHAR(20) NOT NULL,
                        `edition` INT(10) UNSIGNED NOT NULL,
                        `publication_id` INT(10) UNSIGNED NOT NULL,
                        `created_at` TIMESTAMP NULL DEFAULT NULL,
                        `updated_at` TIMESTAMP NULL DEFAULT NULL,
                        PRIMARY KEY(id),
                        FOREIGN KEY(publication_id) REFERENCES publications(id)
                        ON DELETE CASCADE 
          )");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::statement("DROP TABLE books");
    }
}
