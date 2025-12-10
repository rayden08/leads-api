<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        $districts = [
            // Jakarta Selatan (31.71)
            ['code' => '31.71.01', 'name' => 'TEBET', 'city_code' => '31.71'],
            ['code' => '31.71.02', 'name' => 'SETIA BUDI', 'city_code' => '31.71'],
            ['code' => '31.71.03', 'name' => 'MAMPANG PRAPATAN', 'city_code' => '31.71'],
            ['code' => '31.71.04', 'name' => 'PASAR MINGGU', 'city_code' => '31.71'],
            ['code' => '31.71.05', 'name' => 'KEBAYORAN LAMA', 'city_code' => '31.71'],
            ['code' => '31.71.06', 'name' => 'CILANDAK', 'city_code' => '31.71'],
            ['code' => '31.71.07', 'name' => 'KEBAYORAN BARU', 'city_code' => '31.71'],
            ['code' => '31.71.08', 'name' => 'PANCORAN', 'city_code' => '31.71'],
            ['code' => '31.71.09', 'name' => 'JAGAKARSA', 'city_code' => '31.71'],
            ['code' => '31.71.10', 'name' => 'PESANGGRAHAN', 'city_code' => '31.71'],
            
            // Jakarta Timur (31.72)
            ['code' => '31.72.01', 'name' => 'MATRAMAN', 'city_code' => '31.72'],
            ['code' => '31.72.02', 'name' => 'PULOGADUNG', 'city_code' => '31.72'],
            ['code' => '31.72.03', 'name' => 'JATINEGARA', 'city_code' => '31.72'],
            ['code' => '31.72.04', 'name' => 'KRAMAT JATI', 'city_code' => '31.72'],
            ['code' => '31.72.05', 'name' => 'PASAR REBO', 'city_code' => '31.72'],
            ['code' => '31.72.06', 'name' => 'CAKUNG', 'city_code' => '31.72'],
            ['code' => '31.72.07', 'name' => 'DUREN SAWIT', 'city_code' => '31.72'],
            ['code' => '31.72.08', 'name' => 'MAKASAR', 'city_code' => '31.72'],
            ['code' => '31.72.09', 'name' => 'CIRACAS', 'city_code' => '31.72'],
            ['code' => '31.72.10', 'name' => 'CIPAYUNG', 'city_code' => '31.72'],
            
            // Kota Bandung (32.71)
            ['code' => '32.71.01', 'name' => 'BANDUNG KULON', 'city_code' => '32.71'],
            ['code' => '32.71.02', 'name' => 'BABAKAN CIPARAY', 'city_code' => '32.71'],
            ['code' => '32.71.03', 'name' => 'BOJONGLOA KALER', 'city_code' => '32.71'],
            ['code' => '32.71.04', 'name' => 'BOJONGLOA KIDUL', 'city_code' => '32.71'],
            ['code' => '32.71.05', 'name' => 'ASTANA ANYAR', 'city_code' => '32.71'],
            ['code' => '32.71.06', 'name' => 'REGOL', 'city_code' => '32.71'],
            ['code' => '32.71.07', 'name' => 'LENGKONG', 'city_code' => '32.71'],
            ['code' => '32.71.08', 'name' => 'BANDUNG KIDUL', 'city_code' => '32.71'],
            ['code' => '32.71.09', 'name' => 'BUAHBATU', 'city_code' => '32.71'],
            ['code' => '32.71.10', 'name' => 'RANCASARI', 'city_code' => '32.71'],
            
            // Kota Bogor (32.72)
            ['code' => '32.72.01', 'name' => 'BOGOR SELATAN', 'city_code' => '32.72'],
            ['code' => '32.72.02', 'name' => 'BOGOR TIMUR', 'city_code' => '32.72'],
            ['code' => '32.72.03', 'name' => 'BOGOR TENGAH', 'city_code' => '32.72'],
            ['code' => '32.72.04', 'name' => 'BOGOR BARAT', 'city_code' => '32.72'],
            ['code' => '32.72.05', 'name' => 'BOGOR UTARA', 'city_code' => '32.72'],
            ['code' => '32.72.06', 'name' => 'TANAH SAREAL', 'city_code' => '32.72'],
        ];

        District::insert($districts);
    }
}