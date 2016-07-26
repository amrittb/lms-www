<?php

use App\Models\BookCopy;
use Illuminate\Database\Seeder;
use App\Models\ProvisionCategory;

class BookProvidersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = Faker\Factory::create();

        $providers = factory(App\Models\BookProvider::class)->times($faker->numberBetween(1,10))->create();

        $copies = BookCopy::all();
        $categories = ProvisionCategory::all();

        foreach($copies as $copy) {
            $providerKey = $faker->numberBetween(0,$providers->count() - 1);

            $categoryKey = $faker->numberBetween(0,$categories->count() - 1);

            $providers[$providerKey]->bookCopies()->save($copy);
            $categories[$categoryKey]->bookCopies()->save($copy);
        }
    }
}
