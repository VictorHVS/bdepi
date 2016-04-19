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
        $this->call(DadosSeeder::class);
    }
}

class DadosSeeder extends Seeder
{
    public function run()
    {
        //DB::table('dados')->truncate();
        factory(\App\Dados::class, 10)->create();
    }
}
