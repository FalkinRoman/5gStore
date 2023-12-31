<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Cryptocurrency;
use App\Models\Product;
use App\Models\ProductCashback;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        // Используйте запрос для поиска товаров по ключевому слову
        $query = Product::query();

        if (!empty($keyword)) {
            $query->where('name', 'LIKE', '%' . $keyword . '%');
        }

        $products = $query->paginate(10);

        $categories = Category::get();

        return view('admin.products.products', compact('products', 'categories', 'keyword'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //страница формы добавления товара
    {
        $categories = Category::get();
        $cryptocurrencies = Cryptocurrency::get();
        $subcategories = Subcategory::get();
        $brands = Brand::get();
        return view('admin.products.form', compact( 'categories', 'cryptocurrencies', 'subcategories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request) //создание нового продукта
    {
        $params = $request->all();

        // Сохранение изображений
        $images = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products');
                $images[] = $path;
            }
        }

        // Преобразование путей к изображениям в JSON
        $params['image'] = json_encode($images);

        $product = Product::create($params);

        // Добавляем данные о криптовалюте и проценте кэшбэка в таблицу "product_cashbacks"
        if ($request->has('cryptocurrency_id') && $request->has('cashback_percentage')) {
            $cryptocurrencyId = $request->input('cryptocurrency_id');
            $cashbackPercentage = $request->input('cashback_percentage');

            ProductCashback::create([
                'product_id' => $product->id,
                'cryptocurrency_id' => $cryptocurrencyId,
                'cashback_percentage' => $cashbackPercentage,
            ]);
        }

        return redirect()->route('admin.products.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product) //страница одного товара
    {
        // Получаем данные о криптовалюте и кэшбэке для товара, если они есть
        $productCashback = ProductCashback::where('product_id', $product->id)->first();
        $cryptocurrency = $productCashback ? $productCashback->cryptocurrency : null;
        $cashbackPercentage = $productCashback ? $productCashback->cashback_percentage : null;

        return view('admin.products.show', compact('product', 'cryptocurrency', 'cashbackPercentage'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::get();
        $cryptocurrencies = Cryptocurrency::get();
        $subcategories = Subcategory::get();
        $brands = Brand::get();
        return view('admin.products.form', compact('product', 'categories', 'cryptocurrencies', 'subcategories', 'brands'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product) //обновление данных
    {
        $params = $request->all();

        // Обновление изображений
        $images = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products');
                $images[] = $path;
            }

            // Преобразование путей к изображениям в JSON
            $params['image'] = json_encode($images);

            // Удаляем старые изображения
            $oldImages = json_decode($product->image, true);
            foreach ($oldImages as $oldImage) {
                Storage::delete($oldImage);
            }
        }

        foreach (['new', 'hit', 'recommend'] as $fieldName) {
            if (!isset($params[$fieldName])) {
                $params[$fieldName] = 0;
            }
        }

        $product->update($params);

        // Обновляем или создаем запись в таблице "product_cashbacks"
        if ($request->has('cryptocurrency_id') && $request->has('cashback_percentage')) {
            $cryptocurrencyId = $request->input('cryptocurrency_id');
            $cashbackPercentage = $request->input('cashback_percentage');

            // Проверяем, существует ли запись о кэшбэке для данного товара
            $productCashback = ProductCashback::where('product_id', $product->id)->first();

            if ($productCashback) {
                // Если запись существует, обновляем ее
                $productCashback->update([
                    'cryptocurrency_id' => $cryptocurrencyId,
                    'cashback_percentage' => $cashbackPercentage,
                ]);
            } else {
                // Если запись не существует, создаем новую
                ProductCashback::create([
                    'product_id' => $product->id,
                    'cryptocurrency_id' => $cryptocurrencyId,
                    'cashback_percentage' => $cashbackPercentage,
                ]);
            }
        }

        return redirect()->route('admin.products.index');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect() ->route('admin.products.index');
    }
}
