<?php

use Illuminate\Database\Seeder;

class CampSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Camp::class, 10)->create();
    }
}
