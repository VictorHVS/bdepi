<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => 'Victor Hugo',
        'email' => 'vhv.sousa@gmail.com',
        'password' => bcrypt('123456'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Data::class, function (Faker\Generator $faker) {
    return [
        'geom' => new \Phaza\LaravelPostgis\Geometries\Point($faker->latitude, $faker->longitude),
        'data_attain' => $faker->dateTime,
        'title' => $faker->text(10),
        'info' => $faker->realText(50),
        'value' => $faker->realText(20),
        'research_id' => rand(1, 100)
    ];
});

$factory->define(App\Research::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->realText(20),
        'publish_date' => $faker->dateTimeAD,
        'abstract' => $faker->text(200),
        'is_public' => rand(0, 1),
        'user_id' => rand(1, 2)
    ];
});

$factory->define(App\KeyWord::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->text(5)
    ];
});
