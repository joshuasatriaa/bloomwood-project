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
                'name' => 'Jakarta Utara',
                'description' => 'This covers Kelapa Gading, Sunter',
                'small_price' => 10000,
                'medium_price' => 15000
            ],
            [
                'name' => 'Jakarta Barat',
                'description' => 'This covers Kebon Jeruk, Puri, Tanjung Duren',
                'small_price' => 13000,
                'medium_price' => 17000
            ],
            [
                'name' => 'Jakarta Utara 2',
                'description' => 'This covers PIK, Pluit',
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
