<?php

namespace Database\Seeders\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Jenssegers\Mongodb\Eloquent\Model;

trait FakeImageTrait
{
    public function saveImages(Collection $randomImages, Model $model, string $relationName, string $folderName, $isPublic = true)
    {
        $public = $isPublic ? 'public' : 'private';

        foreach ($randomImages as $random) {
            $filename = $this->generateFileName($random);
            $fullPath = $folderName . "/{$filename}.jpg";
            $thumbnailPath = $folderName . "/{$filename}_thumbnail.jpg";
            $image = Image::make(storage_path('app/seeder-images/' . $random));
            $image->save(storage_path("app/{$public}/" . $fullPath), 85, 'jpg');

            $image->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image->save(storage_path("app/{$public}/" . $thumbnailPath), 85, 'jpg');

            $model->{$relationName}()->create([
                'original_image' => $fullPath,
                'thumbnail_image' => $thumbnailPath,
            ]);
        }
    }

    private function generateFileName($imageName)
    {
        $nameOnly = explode('.', $imageName)[0];
        $filename = time() . "_" . Str::random(2) . '_' . preg_replace('/\s+/', '_', strtolower($nameOnly));
        return $filename;
    }
}
