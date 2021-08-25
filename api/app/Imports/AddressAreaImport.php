<?php

namespace App\Imports;

use App\Models\AddressArea;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithLimit;

class AddressAreaImport implements ToModel, WithBatchInserts, WithChunkReading, WithHeadingRow, WithLimit
{
    public function model(array $row)
    {
        return new AddressArea([
            'province' => $row['province'],
            'city' => $row['city'],
            'district' => $row['district'],
            'urban' => $row['urban'],
            'postal_code' => $row['postal_code'],
        ]);
    }

    public function batchSize(): int
    {
        return 10000;
    }

    public function chunkSize(): int
    {
        return 10000;
    }

    public function limit(): int
    {
        return config('app.env') != 'production' ? 500 : 0;
    }
}
