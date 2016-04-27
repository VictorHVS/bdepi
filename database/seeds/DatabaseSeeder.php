<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsuariosSeeder::class);
        $this->call(PesquisasSeeder::class);
        $this->call(DadosSeeder::class);
        $this->call(PalavraChavesSeeder::class);
    }
}

class UsuariosSeeder extends Seeder
{
    public function run()
    {
        factory(\App\User::class, 1)->create();
        \app\User::create(["name" => "Lucas Nogueira", "email" => "lucasnogueira@outlook.com.br", 'password' => bcrypt(123456), 'remember_token' => str_random(10)]);
    }
}

class PesquisasSeeder extends Seeder
{
    public function run()
    {
        factory(\App\Research::class, 100)->create();
    }
}

class DadosSeeder extends Seeder
{
    public function run()
    {
        factory(\App\Data::class, 1000)->create();
    }
}
class PalavraChavesSeeder extends Seeder
{
    public function run()
    {
        factory(\App\KeyWord::class, 50)->create();
    }
}
