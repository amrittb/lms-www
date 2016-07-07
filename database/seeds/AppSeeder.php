<?php

use Illuminate\Database\Seeder;

abstract class AppSeeder extends Seeder{

    /**
     * Turns foreign key checks on
     */
    protected function turnForeignKeyChecksOn() {
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * Turns foreign key checks off
     */
    protected function turnForeignKeyChecksOff() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
    }

    /**
     * Resets a table
     *
     * @param $table
     */
    protected function resetTable($table) {
        $this->turnForeignKeyChecksOff();

        DB::table($table)->truncate();

        $this->turnForeignKeyChecksOn();
    }
}