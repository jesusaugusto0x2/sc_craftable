<?php

use App\Models\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = [
            'Banesco',
            'Banco Mercantil',
            'Banplus',
            'BBVA Provincial',
            'Banco de Venezuela',
            'Banco del Tesoro',
            'Bancaribe',
            'Banco Exterior',
            'Banco Bicentenario',
            'Banco Sofitasa',
            'BOD',
            'Banco del Tesoro',
            '100% Banco'
        ];

        foreach ($banks as $b) {
            Bank::create([
                'name' => $b
            ]);
        }
    }
}
