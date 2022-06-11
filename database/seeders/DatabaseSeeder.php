<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


            Role::factory(5)->create()->each(function ($role){
             $role->user()->saveMany(User::factory(rand(1,2))->make());

        });

//        $this->call([
//            RolesTableSeeder::class,
//            UserTableSeeder::class,
//
//        ]);
    }
}
