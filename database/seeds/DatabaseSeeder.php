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
    }
}

class UsuariosSeeder extends Seeder
{
    public function run()
    {
        factory(\App\Usuario::class, 1)->create();
        \app\Usuario::create(["nome" => "Lucas", "email" => "lucasnogueira@outlook.com.br", 'senha' => bcrypt(123), 'remember_token' => str_random(10)]);
    }
}

class PesquisasSeeder extends Seeder
{
    public function run()
    {
        factory(\App\Pesquisa::class, 10)->create();
    }
}

class DadosSeeder extends Seeder
{
    public function run()
    {
        factory(\App\Dado::class, 100)->create();
    }
}
