<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration  {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::statement("CREATE TABLE transactions (
                        id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE,
                        member_id INT(10) UNSIGNED NOT NULL,
                        librarian_id INT(10) UNSIGNED NOT NULL,
                        book_id INT(10) UNSIGNED NOT NULL,
                        copy_id INT(10) UNSIGNED NOT NULL,
                        issued_at TIMESTAMP NOT NULL,
                        deadline_at TIMESTAMP NOT NULL,
                        completed_at TIMESTAMP,
                        is_completed TINYINT(1) NOT NULL DEFAULT 0,
                        parent_id INT(10),
                        PRIMARY KEY(member_id,librarian_id,book_id,copy_id,issued_at),
                        FOREIGN KEY(member_id) REFERENCES users(id) ON DELETE CASCADE,
                        FOREIGN KEY(librarian_id) REFERENCES users(id) ON DELETE CASCADE,
                        FOREIGN KEY(book_id,copy_id) REFERENCES book_copies(book_id,copy_id) ON DELETE CASCADE
        )");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::statement("DROP TABLE transcations");
    }
}
