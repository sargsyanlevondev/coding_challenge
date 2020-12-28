<?php

use Illuminate\Database\Seeder;

class Offering extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $offeringCount = 10;
        for ($i = 1; $i<$offeringCount; $i++){
            \Illuminate\Support\Facades\DB::table('offering')->insert([
                'title' =>'Offering-' . $i,
                'quantity' => 100,
                'price' => rand (  10 , 100),
            ]);
        }
    }
}
