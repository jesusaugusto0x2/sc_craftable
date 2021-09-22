<?php

use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Jesus',
            'email' => 'jesusaugusto.008@gmail.com',
            'password' => bcrypt(123456),
            'is_blocked' => false
        ]);

        factory(App\Models\User::class, 50)->create();
    }
}
