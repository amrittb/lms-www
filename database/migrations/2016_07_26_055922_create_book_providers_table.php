<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateBookProvidersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::statement('CREATE TABLE book_providers (
            id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
            provider_name VARCHAR(500) NOT NULL,
            contact_no VARCHAR(11) NOT NULL,
            contact_pname VARCHAR(255) NOT NULL,
            PRIMARY KEY(id)
        )');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::statement("DROP TABLE book_providers");
    }
}
