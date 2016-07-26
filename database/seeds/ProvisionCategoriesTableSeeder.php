<?php

use Illuminate\Database\Seeder;

class ProvisionCategoriesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = Faker\Factory::create();

        factory(App\Models\ProvisionCategory::class)->times($faker->numberBetween(1,10))->create();
    }
}
