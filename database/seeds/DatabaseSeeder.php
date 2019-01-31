<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<50; $i++){
            DB::table('houses')->insert([
                'name' => 'The ' . str_random(10),
                'price' => random_int(200000, 700000),
                'bedrooms' => random_int(1, 5),
                'bathrooms' => random_int(1, 5),
                'storeys' => random_int(1, 2),
                'garages' => random_int(1, 2),
            ]);
        }

    }
}
