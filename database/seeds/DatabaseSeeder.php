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
    }
}
