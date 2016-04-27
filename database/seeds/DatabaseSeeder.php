<?php

use App\Models\Data;
use App\Models\KeyWord;
use App\Models\Research;
use App\Models\User;
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
        $this->call(UsersSeeder::class);
        $this->call(ResearchesSeeder::class);
        $this->call(DatasSeeder::class);
        $this->call(KeyWordsSeeder::class);
    }
}

class UsersSeeder extends Seeder
{
    public function run()
    {
        factory(User::class, 1)->create();
        User::create(["name" => "Lucas Nogueira", "email" => "lucasnogueira@outlook.com.br", 'password' => bcrypt("123456"), 'remember_token' => str_random(10)]);
    }
}

class ResearchesSeeder extends Seeder
{
    public function run()
    {
        factory(Research::class, 100)->create();
    }
}

class DatasSeeder extends Seeder
{
    public function run()
    {
        factory(Data::class, 1000)->create();
    }
}
class KeyWordsSeeder extends Seeder
{
    public function run()
    {
        factory(KeyWord::class, 50)->create();
    }
}
