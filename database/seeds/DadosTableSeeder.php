<?php

use Illuminate\Database\Seeder;

class DadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Model::unguard();

        $this->call(DadosTableSeeder::class);

        //Model::reguard();
    }
}
