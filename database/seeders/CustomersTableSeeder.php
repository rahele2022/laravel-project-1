<?php

namespace Database\Seeders;

use App\Models\Customer;
use Database\Factories\CustomerFactory;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Customer::factory()->count(10)->create();

        $faker = \Faker\Factory::create() ;
        foreach (range(1,10) as $item){
            DB::table('customers')->insert([
                'age'=>$faker->randomNumber(2),
                'name'=>$faker->name,
                'family'=>$faker->lastName,
                'email'=> $faker->email,
                'created_at'=>now(),
                'updated_at'=>now()

            ]);
        }

    }
}
