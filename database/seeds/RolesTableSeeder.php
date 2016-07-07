<?php

class RolesTableSeeder extends AppSeeder {
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->resetTable('roles');

        DB::table('roles')->insert([
            [
               'role_name' => 'Administrator'
            ],
            [
                'role_name' => 'Librarian'
            ],
            [
                'role_name' => 'Member'
            ]
        ]);
    }
}
