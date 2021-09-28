<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $currencies = ['btc', 'eth', 'fil'];
        foreach($currencies as $value) {
            $curreny = Currency::create(['name' => $value, 'description' => $value]);
            $curreny->save();
        }
    }
}
