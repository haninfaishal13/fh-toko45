<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'category_id' => '1',
                'name' => 'Bolpoin Standard AE7',
                'quantity' => 50,
                'price' => 3000
            ],
            [
                'category_id' => '1',
                'name' => 'Bolpoin Pilot',
                'quantity' => 50,
                'price' => 3500
            ],
            [
                'category_id' => '1',
                'name' => 'Bolpoin Faster',
                'quantity' => 50,
                'price' => 3500
            ],
            [
                'category_id' => '1',
                'name' => 'Bolpoin Ink Gel',
                'quantity' => 50,
                'price' => 4000
            ]
        ];

        foreach($data as $d) {
            Product::create($d);
        }
    }
}
