<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsFilterRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;


class MainConroller extends Controller
{
    public function index(ProductsFilterRequest $request) {
        $productsQuery = Product::with('category');  //поменял query() на with('category') для оптимизации
        if ($request->filled('price_from')) {
            $productsQuery->where('price', '>=', $request->price_from);
        }
        if ($request->filled('price_to')) {
            $productsQuery->where('price', '<=', $request->price_to);
        }
        foreach (['hit','new','recommend'] as $field) {
            if ($request->has($field)) {
                $productsQuery->$field();
                //$productsQuery->where($field, 1); Убрали так как добавили метод scope
            }
        }
        $products = $productsQuery->Paginate(10)->withPath("?" . $request->getQueryString());
        return view('index', compact('products'));
    }

    public function categories() {
        $categories = Category::get();
        return view('categories', ['categories'=>$categories]);
    }

    public function category($code) {
        $category = Category::where('code', $code)->first();
        return view('category', compact('category'));
    }

    public function product($category, $productCode) {
        $product = Product::byCode($productCode)->first();
        return view('product', compact('product'));
    }


}

