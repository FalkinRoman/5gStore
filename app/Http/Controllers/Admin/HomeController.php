<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function orders() {
        $orders = Order::active()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order) {
        $products = $order->products()->withTrashed()->get();   //ищем все продукты но также и удаленные файлы забираем
        return view('admin.orders.show', compact('order', 'products'));
    }
}
