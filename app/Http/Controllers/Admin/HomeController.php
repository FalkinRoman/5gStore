<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function orders() {
        $orders = Order::where('status', 1)->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order) {
        return view('admin.orders.show', compact('order'));
    }
}
