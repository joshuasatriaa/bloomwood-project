<?php

namespace App\Services;

use App\Models\Category;
use App\Models\SubCategory;
use Jenssegers\Mongodb\Eloquent\Model;

class CategoryService
{
    /**
     * Attach the model to each categories
     * @param Model $model
     * @param array $categoryIds
     * @param string $relationName Category relationship function name from category to {model}
     * 
     * @return void
     */
    public function attachModelToCategories(Model $model, array $categoryIds, string $relationName): void
    {
        $categories = Category::whereIn('_id', $categoryIds)->get();

        foreach ($categoryIds as $id) {
            $c = $categories->find($id);
            $c->{$relationName}()->attach($model->id);
        }
    }
}
