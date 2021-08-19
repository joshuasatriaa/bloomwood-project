<?php

namespace App\Services;

use App\Services\Contracts\ImageServiceContract;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageService implements ImageServiceContract
{
    /**
     * Upload multiple images to specified folder
     * 
     */
    public function uploadImages(Request $request, string $folderName, string $requestArrayField)
    {
        $result = [];
        $requestImages = $request->file($requestArrayField);

        if ($requestImages) {
            foreach ($requestImages as $index => $val) {
                $originalImage = $requestImages[$index];
                $originalPath = $this->saveOriginalImage($originalImage, $folderName);
                $thumbPath = $this->saveThumbnailImage($originalImage, $folderName);

                array_push($result, [
                    'original_image' => $originalPath,
                    'thumbnail_image' => $thumbPath
                ]);
            }
        }

        return $result;
    }

    private function saveOriginalImage($originalImage, $folderName)
    {
        $newImage = Image::make($originalImage);
        $path = $this->generatePath($originalImage, $folderName);
        $newImage->save(storage_path('app/public/' . $path), 85, 'jpg');

        return $path;
    }

    private function saveThumbnailImage($originalImage, $folderName)
    {
        $newImage = Image::make($originalImage);
        $path = $this->generatePath($originalImage, $folderName, true);
        $newImage->save(storage_path('app/public/' . $path), 85, 'jpg');

        return $path;
    }


    private function generatePath($originalImage, $folderName, $thumbnail = false): string
    {
        $thumbInfo = $thumbnail ? 'thumbnail_' : '';
        $filename = time() . "_" . $thumbInfo . preg_replace('/\s+/', '_', strtolower($originalImage->getClientOriginalName()));
        return $filename ? $folderName . '/' . $filename : null;
    }
}
