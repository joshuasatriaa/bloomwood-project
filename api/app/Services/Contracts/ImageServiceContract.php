<?php

namespace App\Services\Contracts;

use Illuminate\Http\Request;

interface ImageServiceContract
{
    public function uploadImages(Request $request, string $folderName, string $requestArrayField);
}
