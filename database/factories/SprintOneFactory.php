<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\Tag::class, function (Faker $faker) {
    return [
        'label' => $faker->word(),
    ];
});

$factory->define(App\Models\Specialite::class, function (Faker $faker) {
    return [
        'label' => $faker->word(),
    ];
});

$factory->define(App\Models\Medecin::class, function (Faker $faker) {
    return [
        'cin' => $faker->ean8(),
        'nom' => $faker->firstName(),
        'prenom' => $faker->lastName(),
        'specialite_id' => App\Models\Specialite::all()->random()->id,
        'telephone' => $faker->phoneNumber(),
        'email' => $faker->email(),
        'adresse' => $faker->address(),
        
    ];
});

$factory->define(App\Models\Post::class, function (Faker $faker) {
    return [
        'titre' => $faker->sentence(),
        'description' => $faker->paragraph(random_int(8,30)),

    ];
});



