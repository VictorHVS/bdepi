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
        'name' => "Victor Hugo Vieira de Sousa",
        'email' => "vhv.sousa@gmail.com",
        'password' => bcrypt("123456"),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Data::class, function (Faker\Generator $faker) {
    return [
        'geom' => new \Phaza\LaravelPostgis\Geometries\Point($faker->latitude, $faker->longitude),
        'data_coleta' => $faker->dateTime,
        'nome' => $faker->text(10),
        'info' => $faker->realText(50),
        'valor' => $faker->realText(20),
        'pesquisa_id' => rand(1, 100)
    ];
});

$factory->define(App\Research::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->realText(20),
        'data_publicacao' => $faker->dateTimeAD,
        'resumo' => $faker->text(200),
        'is_publico' => rand(0, 1),
        'usuario_id' => rand(1, 2)
    ];
});

$factory->define(App\KeyWord::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->text(5)
    ];
});
