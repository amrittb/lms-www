<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Tables to Seed
     *
     * @var array
     */
    protected $tables = [
        RolesTableSeeder::class,
        UsersTableSeeder::class,
        PublicationsTableSeeder::class,
        BookCategoriesTableSeeder::class,
        BooksTableSeeder::class,
        BookCopiesTableSeeder::class,
        AuthorsTableSeeder::class,
        ProvisionCategoriesTableSeeder::class,
        BookProvidersTableSeeder::class
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        
        foreach($this->tables as $table) {
            $this->call($table);
        }
    }
}
