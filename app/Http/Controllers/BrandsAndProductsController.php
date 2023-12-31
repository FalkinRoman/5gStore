<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class BrandsAndProductsController extends Controller
{

    //Получить все субкатегории и бренды
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




    //Получить все бренды для категории и субкатегории
    public function getBrands($categoryId, $brandOrSubcategoryId)
    {

        // Найти субкатегорию по ID
        $subcategory = Subcategory::find($brandOrSubcategoryId);

        if (!$subcategory) {
            return response()->json(['error' => 'Субкатегория не найдена'], 404);
        }

        // Получить все бренды для данной субкатегории
        $brands = Brand::whereIn('id', function ($query) use ($categoryId, $brandOrSubcategoryId) {
            $query->select('brand_id')
                ->from('products')
                ->where('category_id', $categoryId)
                ->where('subcategory_id', $brandOrSubcategoryId)
                ->whereNotNull('brand_id');
        })->get();

        return response()->json([
            'brands' => $brands,
        ]);
    }


    //Получить все продукты для категории и бренда
    public function getProducts($categoryId, $brandId)
    {
        // Найти бренд по ID
        $brand = Brand::find($brandId);

        if (!$brand) {
            return response()->json(['error' => 'Бренд не найден'], 404);
        }

        // Получить все продукты для данной категории и бренда
        $products = Product::where('category_id', $categoryId)
            ->where('brand_id', $brandId)
            ->get();

        return response()->json([
            'products' => $products,
        ]);
    }
}
