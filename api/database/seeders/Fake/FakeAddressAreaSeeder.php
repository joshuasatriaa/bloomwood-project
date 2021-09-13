<?php

namespace Database\Seeders\Fake;

use App\Imports\AddressAreaImport;
use App\Models\AddressArea;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class FakeAddressAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $areas = [
            [
                'name' => 'Kelapa Gading',
                'description' => 'Kelapa Gading Area',
                'small_price' => 10000,
                'medium_price' => 15000
            ],
            [
                'name' => 'Sunter',
                'description' => 'Sunter area',
                'small_price' => 13000,
                'medium_price' => 17000
            ],
            [
                'name' => 'Kemayoran',
                'description' => 'Kemayoran area',
                'small_price' => 5000,
                'medium_price' => 10000
            ],
        ];
        // Excel::import(new AddressAreaImport, 'data-imports/kode-pos.csv', 'local');

        foreach ($areas as $area) {
            AddressArea::create($area);
        }
    }
}
