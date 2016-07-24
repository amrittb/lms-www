<?php

/**
 * Defines a User Model Factory
 */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'expires_at' => \Carbon\Carbon::now()->addYear($faker->numberBetween(1,3)),
        'role_id' => $faker->randomElement(\App\Models\Role::lists('id')->toArray())
    ];
});

/**
 * Defines a Publication Model factory
 */
$factory->define(App\Models\Publication::class, function (Faker\Generator $faker) {
    return [
        'publication_name' => $faker->company
    ];
});

/**
 * Defines a Book Model factory
 */
$factory->define(App\Models\Book::class, function(Faker\Generator $faker) {
    $publications = App\Models\Publication::lists('id');
    $categories = App\Models\BookCategory::lists('id');

    return [
        'book_name' => $faker->sentence(4),
        'isbn' => $faker->isbn10,
        'edition' => $faker->numberBetween(1,10),
        'publication_id' => $faker->randomElement($publications->toArray()),
        'category_id' => $faker->randomElement($categories->toArray()),
    ];
});

/**
 * Defines a Book Category Model factory
 */
$factory->define(App\Models\BookCategory::class,function(Faker\Generator $faker){
   return [
       'category_name' => $faker->word
   ];
});