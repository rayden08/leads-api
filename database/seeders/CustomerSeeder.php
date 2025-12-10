<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\PhoneNumber;
use App\Models\Address;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            [
                'name' => 'PT. ABC Indonesia',
                'email' => 'contact@abcindonesia.com',
                'address' => 'Jl. Sudirman No. 123'
            ],
            [
                'name' => 'CV. Mandiri Jaya',
                'email' => 'info@mandirijaya.co.id',
                'address' => 'Jl. Thamrin No. 45'
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@gmail.com',
                'address' => 'Jl. Merdeka No. 67'
            ],
            [
                'name' => 'Sari Wangi Boutique',
                'email' => 'sari@wangiboutique.com',
                'address' => 'Jl. Kebon Sirih No. 89'
            ],
            [
                'name' => 'Toko Elektronik Maju',
                'email' => 'sales@tokomaju.com',
                'address' => 'Jl. Pasar Baru No. 101'
            ],
        ];

        foreach ($customers as $customerData) {
            $customer = Customer::create($customerData);
            
            // Add phone numbers
            PhoneNumber::create([
                'customer_id' => $customer->id,
                'number' => '0812' . rand(1000000, 9999999),
                'type' => 'mobile'
            ]);
            
            // Add address detail
            Address::create([
                'customer_id' => $customer->id,
                'province_code' => '31',
                'city_code' => '31.71',
                'district_code' => '31.71.01',
                'village_code' => '31.71.01.1001',
                'postal_code' => '12810',
                'full_address' => $customerData['address'] . ', Jakarta Selatan'
            ]);
        }
    }
}