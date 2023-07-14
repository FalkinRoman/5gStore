<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home() {
        $orders = Order::where('status', 1)->get();
        return view('admin.home', compact('orders'));
    }
}
