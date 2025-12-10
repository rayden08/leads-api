<?php

namespace Database\Seeders;

use App\Models\Village;
use Illuminate\Database\Seeder;

class VillageSeeder extends Seeder
{
    public function run(): void
    {
        $villages = [
            // Tebet, Jakarta Selatan (31.71.01)
            ['code' => '31.71.01.1001', 'name' => 'TE BET BARAT', 'district_code' => '31.71.01', 'postal_code' => '12810'],
            ['code' => '31.71.01.1002', 'name' => 'TE BET TIMUR', 'district_code' => '31.71.01', 'postal_code' => '12820'],
            ['code' => '31.71.01.1003', 'name' => 'KE BON BARU', 'district_code' => '31.71.01', 'postal_code' => '12830'],
            ['code' => '31.71.01.1004', 'name' => 'MANGGARAI SELATAN', 'district_code' => '31.71.01', 'postal_code' => '12860'],
            
            // Setia Budi, Jakarta Selatan (31.71.02)
            ['code' => '31.71.02.1001', 'name' => 'KARET SEMANGGI', 'district_code' => '31.71.02', 'postal_code' => '12930'],
            ['code' => '31.71.02.1002', 'name' => 'KUNINGAN BARAT', 'district_code' => '31.71.02', 'postal_code' => '12710'],
            ['code' => '31.71.02.1003', 'name' => 'PASAR MANGGIS', 'district_code' => '31.71.02', 'postal_code' => '12970'],
            ['code' => '31.71.02.1004', 'name' => 'GUNTUR', 'district_code' => '31.71.02', 'postal_code' => '12980'],
            
            // Matraman, Jakarta Timur (31.72.01)
            ['code' => '31.72.01.1001', 'name' => 'PISANGAN BARU', 'district_code' => '31.72.01', 'postal_code' => '13110'],
            ['code' => '31.72.01.1002', 'name' => 'PISANGAN TIMUR', 'district_code' => '31.72.01', 'postal_code' => '13110'],
            ['code' => '31.72.01.1003', 'name' => 'KAYU MANIS', 'district_code' => '31.72.01', 'postal_code' => '13130'],
            ['code' => '31.72.01.1004', 'name' => 'UTAN KAYU SELATAN', 'district_code' => '31.72.01', 'postal_code' => '13120'],
            
            // Pulogadung, Jakarta Timur (31.72.02)
            ['code' => '31.72.02.1001', 'name' => 'PULO GADUNG', 'district_code' => '31.72.02', 'postal_code' => '13260'],
            ['code' => '31.72.02.1002', 'name' => 'JATI', 'district_code' => '31.72.02', 'postal_code' => '13220'],
            ['code' => '31.72.02.1003', 'name' => 'RAWAMANGUN', 'district_code' => '31.72.02', 'postal_code' => '13220'],
            ['code' => '31.72.02.1004', 'name' => 'KAYU PUTIH', 'district_code' => '31.72.02', 'postal_code' => '13210'],
            
            // Bandung Kulon, Kota Bandung (32.71.01)
            ['code' => '32.71.01.1001', 'name' => 'CIAWI', 'district_code' => '32.71.01', 'postal_code' => '40115'],
            ['code' => '32.71.01.1002', 'name' => 'CIGONDEWAH KALER', 'district_code' => '32.71.01', 'postal_code' => '40114'],
            ['code' => '32.71.01.1003', 'name' => 'CIGONDEWAH KIDUL', 'district_code' => '32.71.01', 'postal_code' => '40114'],
            ['code' => '32.71.01.1004', 'name' => 'CIGONDEWAH RAHAYU', 'district_code' => '32.71.01', 'postal_code' => '40114'],
            
            // Babakan Ciparay, Kota Bandung (32.71.02)
            ['code' => '32.71.02.1001', 'name' => 'BABAKAN', 'district_code' => '32.71.02', 'postal_code' => '40223'],
            ['code' => '32.71.02.1002', 'name' => 'BABAKAN CIPARAY', 'district_code' => '32.71.02', 'postal_code' => '40223'],
            ['code' => '32.71.02.1003', 'name' => 'SITUSAEUR', 'district_code' => '32.71.02', 'postal_code' => '40223'],
            ['code' => '32.71.02.1004', 'name' => 'SUKAHALU', 'district_code' => '32.71.02', 'postal_code' => '40223'],
            
            // Bogor Selatan, Kota Bogor (32.72.01)
            ['code' => '32.72.01.1001', 'name' => 'BATU TULIS', 'district_code' => '32.72.01', 'postal_code' => '16133'],
            ['code' => '32.72.01.1002', 'name' => 'BONDongan', 'district_code' => '32.72.01', 'postal_code' => '16131'],
            ['code' => '32.72.01.1003', 'name' => 'EMPANG', 'district_code' => '32.72.01', 'postal_code' => '16132'],
            ['code' => '32.72.01.1004', 'name' => 'LAWIJAYA', 'district_code' => '32.72.01', 'postal_code' => '16134'],
            
            // Bogor Timur, Kota Bogor (32.72.02)
            ['code' => '32.72.02.1001', 'name' => 'BARANANGSIANG', 'district_code' => '32.72.02', 'postal_code' => '16143'],
            ['code' => '32.72.02.1002', 'name' => 'KATULAMPA', 'district_code' => '32.72.02', 'postal_code' => '16142'],
            ['code' => '32.72.02.1003', 'name' => 'SINDANGSARI', 'district_code' => '32.72.02', 'postal_code' => '16144'],
            ['code' => '32.72.02.1004', 'name' => 'TAJUR', 'district_code' => '32.72.02', 'postal_code' => '16145'],
        ];

        Village::insert($villages);
    }
}