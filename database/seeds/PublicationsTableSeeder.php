<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class PublicationsTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = Factory::create();

        factory(App\Models\Publication::class)->times($faker->numberBetween(1,5))->create();
    }
}
