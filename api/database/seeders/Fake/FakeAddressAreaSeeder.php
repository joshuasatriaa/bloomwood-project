<?php

namespace Database\Seeders\Fake;

use App\Imports\AddressAreaImport;
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
        Excel::import(new AddressAreaImport, 'data-imports/kode-pos.csv', 'local');
    }
}
