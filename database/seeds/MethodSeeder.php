<?php

use App\Models\Method;
use Illuminate\Database\Seeder;

class MethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $methods = [
            'Transferencia', 'Depósito', 'Efectivo'
        ];

        foreach ($methods as $m) {
            Method::create([
                'name' => $m
            ]);
        }
    }
}
