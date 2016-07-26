<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddProviderIdColumnToBookCopiesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::statement("ALTER TABLE book_copies 
                        ADD provider_id INT(10) UNSIGNED NULL, 
                        ADD provision_category_id INT(10) UNSIGNED NULL,
                        ADD FOREIGN KEY(provider_id) 
                        REFERENCES book_providers(id) 
                        ON DELETE SET NULL, 
                        ADD FOREIGN KEY(provision_category_id) 
                        REFERENCES provision_categories(id) 
                        ON DELETE SET NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::statement("ALTER TABLE book_copies DROP COLUMN provider_id, DROP COLUMN provision_category_id");
    }
}
