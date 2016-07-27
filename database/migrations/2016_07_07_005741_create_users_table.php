<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::statement("CREATE TABLE `users` (
                        `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                        `first_name` VARCHAR(30) NOT NULL,
                        `middle_name` VARCHAR(30) DEFAULT NULL,
                        `last_name` VARCHAR(30) NOT NULL,
                        `email` VARCHAR(60) NOT NULL UNIQUE,
                        `password` VARCHAR(100) NOT NULL,
                        `expires_at` TIMESTAMP DEFAULT NULL,
                        `role_id` int(10) UNSIGNED NOT NULL,
                        `remember_token` VARCHAR(100) DEFAULT NULL,
                        `created_at` TIMESTAMP DEFAULT NULL,
                        `updated_at` TIMESTAMP DEFAULT NULL,
                        PRIMARY KEY(id),
                        FOREIGN KEY(role_id) REFERENCES roles(id)
                        ON DELETE CASCADE
        )");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::statement("DROP TABLE users");
    }
}
