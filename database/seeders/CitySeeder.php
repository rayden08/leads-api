<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            // DKI Jakarta
            ['code' => '31.01', 'name' => 'KAB. ADM. KEP. SERIBU', 'province_code' => '31'],
            ['code' => '31.71', 'name' => 'KOTA ADM. JAKARTA SELATAN', 'province_code' => '31'],
            ['code' => '31.72', 'name' => 'KOTA ADM. JAKARTA TIMUR', 'province_code' => '31'],
            
            // Jawa Barat
            ['code' => '32.01', 'name' => 'KAB. BOGOR', 'province_code' => '32'],
            ['code' => '32.02', 'name' => 'KAB. SUKABUMI', 'province_code' => '32'],
            ['code' => '32.03', 'name' => 'KAB. CIANJUR', 'province_code' => '32'],
            ['code' => '32.71', 'name' => 'KOTA BANDUNG', 'province_code' => '32'],
            ['code' => '32.72', 'name' => 'KOTA BOGOR', 'province_code' => '32'],
        ];

        City::insert($cities);
    }
}