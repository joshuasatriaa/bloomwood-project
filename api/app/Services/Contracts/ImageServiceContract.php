<?php

namespace App\Services\Contracts;

use Illuminate\Http\Request;

interface ImageServiceContract
{
    public function uploadImages(Request $request, string $folderName, string $requestArrayField);
    public function uploadThumbnails(Request $request, string $folderName, string $requestArrayField, string $field);
    public function uploadThumbnail(Request $request, string $folderName, string $field);
}
