<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsFilterRequest;
use App\Http\Requests\SubscriptionRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class MainConroller extends Controller
{
    public function index(Request $request)
    {
        // Ключ для кэширования, основанный на параметрах запроса
        $cacheKey = 'products_query_' . md5(serialize($request->all()));

        // Получение данных из кэша или выполнение запроса
        $products = Cache::remember($cacheKey, now()->addMinutes(30), function () use ($request) {
            $productsQuery = Product::with(['category', 'cryptocurrencies', 'cashbacks']);

            if ($request->filled('price_from')) {
                $productsQuery->where('price', '>=', $request->price_from);
            }

            if ($request->filled('price_to')) {
                $productsQuery->where('price', '<=', $request->price_to);
            }

            foreach (['hit', 'new', 'recommend'] as $field) {
                if ($request->has($field)) {
                    $productsQuery->$field();
                }
            }

            if ($request->filled('search')) {
                $searchTerm = $request->input('search');
                $productsQuery->where('name', 'like', '%' . $searchTerm . '%');
            }

            return $productsQuery->paginate(10);
        });

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

    public function productData($productCode)
    {
        $product = Product::where('code', $productCode)->first();

        // Верните данные в формате JSON
        return response()->json($product);
    }

    public function product($productCode)
    {
        $product = Product::where('code', $productCode)->first();

        if (!$product) {
            return redirect()->route('index')->with('error', 'Продукт не найден');
        }
        // Получите список всех товаров
        $products = Product::all();

        return view('index', compact('product', 'products'));
    }



    public function subscribe(SubscriptionRequest $request, Product $product) {  //Создает уведомление на наличие товара в продаже
        Subscription::create([
            'email' => $request->email,
            'product_id' => $product->id,
        ]);

        return redirect()->back()->with('success', 'Спасибо, мы сообщим вам о поступлении товара');
    }


//    public function search(Request $request) //поиск для продуктов
//    {
//        $query = $request->input('query');
//
//        $products = Product::where('name', 'like', "%$query%")->get();
//
//        return view('products.search', compact('products'));
//    }



}

