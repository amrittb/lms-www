<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateRolesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::statement("CREATE TABLE roles(
            id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
            role_name VARCHAR(255) NOT NULL,
            PRIMARY KEY(id)
        )");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::statement("DROP TABLE roles");
    }
}
