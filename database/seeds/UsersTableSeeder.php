<?php

class UsersTableSeeder extends AppSeeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(App\Models\User::class,10)->create([
            'password' => bcrypt('password')
        ]);
    }
}
