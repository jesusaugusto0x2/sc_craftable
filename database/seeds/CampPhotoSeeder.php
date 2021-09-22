<?php

use Illuminate\Database\Seeder;

use App\Models\Camp;
use App\Models\CampPhoto;
use Faker\Factory as Faker;


class CampPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $camps = Camp::all();

        $faker = Faker::create();

        foreach ($camps as $camp) {
            //Creating 3 pictures per camp
            for ($i = 0; $i <  3; $i++) {
                CampPhoto::create([
                    // 'url'   =>  'https://i.picsum.photos/id/' . random_int(100, 999) . '/500/500.jpg',
                    'url' => 'http://lorempixel.com/640/480/',
                    'camp_id'   =>  $camp->id
                ]);
            }
        }
    }
}
