<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
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
                'name' => 'ATK',
                'category_code' => 'ATK',
                'section' => 'toko'
            ],
            [
                'name' => 'Atribut Sekolah',
                'category_code' => 'ATS',
                'section' => 'toko',
            ],
            [
                'name' => 'Kuitansi',
                'category_code' => 'KTW',
                'section' => 'toko'
            ]
        ];

        foreach($data as $d) {
            Category::create($d);
        }
    }
}
