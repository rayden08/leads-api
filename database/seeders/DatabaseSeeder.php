<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ProvinceSeeder::class,
            CitySeeder::class,
            DistrictSeeder::class,     
            VillageSeeder::class,       
            ProductSeeder::class,
            CustomerSeeder::class,   
          
            
        ]);
    }
}