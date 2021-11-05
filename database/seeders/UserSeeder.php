<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();

        foreach(range(1,10) as $index){
            DB::table('users')->insert([
                'name' =>$faker->name,
                'email' =>$faker->email(),
                'password' => 'password',

                // this method x push date, sebab tu this method produce data with no time stamp
            ]);

            
        }
    }
}
