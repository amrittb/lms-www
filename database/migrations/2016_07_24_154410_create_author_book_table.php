<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateAuthorBookTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::statement('CREATE TABLE author_book(
            author_id INT(10) UNSIGNED NOT NULL,
            book_id INT(10) UNSIGNED NOT NULL,
            PRIMARY KEY(author_id,book_id),
            FOREIGN KEY(author_id) REFERENCES authors(id) ON DELETE CASCADE,
            FOREIGN KEY(book_id) REFERENCES books(id) ON DELETE CASCADE
        )');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::statement('DROP TABLE author_book');
    }
}
