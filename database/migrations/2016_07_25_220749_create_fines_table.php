<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateFinesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::statement("CREATE TABLE fines(
              id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
              fine_amt FLOAT(10,2) UNSIGNED NOT NULL,
              transaction_id INT(10) UNSIGNED NOT NULL,
              PRIMARY KEY(id),
              FOREIGN KEY(transaction_id) REFERENCES transactions(id)
              ON DELETE CASCADE
          )");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::statement("DROP TABLE fines");
    }
}
