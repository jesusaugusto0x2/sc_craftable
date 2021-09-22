<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Camp;

class CampSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $camps = [];

        for ($i = 0; $i < 10; $i++) {
            $camps[] = [
                'location'  =>  $faker->address(),
                'entries'   =>  rand(5, 10),
                'cost'      =>  rand(1000, 9000),
                'date'      =>  $faker->dateTimeBetween('-1 years', 'now')
            ];
        }

        foreach ($camps as $camp) {
            Camp::create($camp);
        }
    }
}
