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

$factory->define(App\Usuario::class, function (Faker\Generator $faker) {
    return [
        'nome' => 'Victor',
        'email' =>'vhv.sousa@gmail.com',
        'senha' => bcrypt(123),
        'remember_token' => str_random(10)
    ];
});

$factory->define(App\Dado::class, function (Faker\Generator $faker) {
    return [
        'geom' => new \Phaza\LaravelPostgis\Geometries\Point($faker->latitude, $faker->longitude),
        'data_coleta' => $faker->dateTime,
        'nome' => $faker->text(10),
        'info' => $faker->realText(50),
        'valor' => $faker->realText(20),
        'pesquisa_id' => rand(1, 10)
    ];
});

$factory->define(App\Pesquisa::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->title,
        'data_publicacao' => $faker->dateTimeAD,
        'resumo' => $faker->text(200),
        'is_publico' => rand(0, 1),
        'usuario_id' => rand(1, 2)
    ];
});
