<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoriesAndBrandsController extends Controller
{

    public function getSubcategoriesAndBrands($categoryId)
    {
        // Найти категорию по ID
        $category = Category::find($categoryId);

        // Получить все субкатегории для данной категории, если они есть
        $subcategories = Subcategory::whereIn('id', function ($query) use ($categoryId) {
            $query->select('subcategory_id')
                ->from('products')
                ->whereIn('category_id', [$categoryId])
                ->whereNotNull('subcategory_id');
        })->get();

        // Получить все бренды для данной категории
        $brands = Brand::whereIn('id', function ($query) use ($categoryId) {
            $query->select('brand_id')
                ->from('products')
                ->whereIn('category_id', [$categoryId])
                ->whereNotNull('brand_id');
        })->get();

        return response()->json([
            'subcategories' => $subcategories,
            'brands' => $brands,
        ]);
    }
}
