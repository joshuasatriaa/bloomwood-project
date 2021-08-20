<?php

namespace App\Services;

use App\Services\Contracts\ImageServiceContract;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageService implements ImageServiceContract
{

    public function uploadThumbnails(Request $request, string $folderName, string $requestArrayField, string $field)
    {
        $result = [];
        $requestImages = $request->file($requestArrayField);

        if ($requestImages) {
            foreach ($requestImages as $index => $val) {
                $thumbPath = $this->saveThumbnailImage($requestImages[$index][$field], $folderName);

                array_push($result, $thumbPath);
            }
        }

        return $result;
    }

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
        $newImage->resize(null, 200, function ($constraint) {
            $constraint->aspectRatio();
        });
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
