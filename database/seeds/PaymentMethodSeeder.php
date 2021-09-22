<?php

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentMethods = [
            'Transferencia Bancaria',
            'Transferencia Internacional',
            'Efectivo',
            'Zelle',
            'BOFA',
            'Trueque'
        ];

        foreach ($paymentMethods as $b) {
            PaymentMethod::create([
                'name' => $b
            ]);
        }
    }
}
