<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Cryptocurrency;
use App\Models\Product;
use App\Models\ProductCashback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //страница товаров
    {
        $products = Product::paginate(10);
        $categories = Category::get();
        return view('admin.products.products', compact('products', 'categories'));
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
        return view('admin.products.form', compact( 'categories', 'cryptocurrencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request) //создание нового товара
    {
        $params = $request->all();
        unset($params['image']);
        if ($request->has('image')) {
            $path = $request->file('image')->store('products');
            $params['image'] = $path;
        }

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
        return view('admin.products.form', compact('product', 'categories', 'cryptocurrencies'));
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
        unset($params['image']);
        if ($request->has('image')) {
            Storage::delete($product->image);
            $path = $request->file('image')->store('products');
            $params['image'] = $path;
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
