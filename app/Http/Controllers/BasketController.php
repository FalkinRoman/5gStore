<?php

namespace App\Http\Controllers;

use App\Classes\Basket;
use App\Http\Requests\BasketConfirmRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BasketController extends Controller
{
    public function basket()    //Страница корзины
    {
        $order = (new Basket())->getOrder();
        return view('basket', compact('order'));
    }

    public function basketPlace()  //Страница оформления заказа
    {
        $basket = new Basket();
        $order = $basket->getOrder();
        if(!$basket->countAvailable()){
            session()->flash('warning', 'Товар не доступен для заказа в полном обьеме');
            return redirect()->route('basket');
        }
        return view('order', compact('order'));
    }

    public function basketConfirm(BasketConfirmRequest $request)   //Потвердить заказ
    {
        $email = Auth::check() ? Auth::user()->email : $request->email;
        if ((new Basket())->saveOrder($request->name, $request->phone, $email)) {
            session()->flash('success', 'Ваш заказ принят в обработку!');
        }else{
            session()->flash('warning', 'Товар не доступен для заказа в полном обьеме');
        }
        Order::eraceOrderSum();
        return redirect()->route('index');
    }



    public function basketAdd(Request $request,Product $product)  //Добавление товара в корзину
    {
        $result = (new Basket(true))->addProduct($product);
        if ($result) {
            session()->flash('success', 'Добавлен товар ' . $product->name);
        }else{
            session()->flash('warning', 'Товар ' . $product->name . ' в большем кол-ве не доступен для заказа');
        }

        // Возвращаем страницу корзины с товарами
        return redirect()->route('basket');
    }


    public function basketRemove( Product $product)    //Удаление товара с корзины
    {
        (new Basket())->removeProduct($product);
        session()->flash('warning', 'Удален товар ' . $product->name);
        return redirect()->route('basket');
    }

}











