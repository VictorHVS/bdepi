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
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Dados::class, function (Faker\Generator $faker) {
    return [
        'geom' => new \Phaza\LaravelPostgis\Geometries\Point($faker->latitude, $faker->longitude),
        'data_coleta' => $faker->dateTime,
        'nome' => $faker->text(10),
        'info' => $faker->realText(50),
        'valor' => $faker->realText(20)
    ];
});
