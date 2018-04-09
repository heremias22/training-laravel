<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
        User::create([
            "username" => "usuario",
            "name" => "usuario",
            "email" => "usuario@usuario.com",
            "password" => bcrypt("usuario"),
            "user_type" => "admin"]);


        Subreddit::create([
            "creator_id" => 1,
            "name" => "Games",
            "description" => "A place to talk about videogames"]);
    }
}
