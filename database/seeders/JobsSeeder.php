<?php

namespace Database\Seeders;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class JobsSeeder extends Seeder
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

        foreach(range(1,180) as $index){
            DB::table('employee_jobs')->insert([
                'title' =>$faker->sentence(3),
                'description' =>$faker->text(),
                'min_salary' => 4000,
                'max_salary' => 7000,

                // this method x push date, sebab tu this method produce data with no time stamp
            ]);

            
        }
    }
}
