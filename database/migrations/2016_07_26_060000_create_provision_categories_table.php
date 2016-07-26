<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateProvisionCategoriesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::statement("CREATE TABLE provision_categories(
            id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
            category_name VARCHAR(255) NOT NULL,
            PRIMARY KEY(id)
        )");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::statement("DROP TABLE provision_categories");
    }
}
