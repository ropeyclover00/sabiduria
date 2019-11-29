<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	"email"=>"ramirezcastorena_b@outlook.com",
        	"password"=>Hash::make("angel2019"),
        	"name"=>"Angel",
        	"last_name" => "Ramirez",
        	"rol"=>2,
            "email_verified_at" => "2019-11-28 00:00:00",
            "created_at" => "2019-11-28 00:00:00",

        ]);

        DB::table('users')->insert([
        	"email"=>"castorenamartin@hotmail.com",
        	"password"=>Hash::make("angel2019"),
        	"name"=>"Martin",
        	"last_name" => "Castorena",
        	"rol"=>1,
            "email_verified_at" => "2019-11-28 00:00:00",
            "created_at" => "2019-11-28 00:00:00",
        ]);

    }
}
