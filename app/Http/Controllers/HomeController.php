<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home() {
        $orders = Auth::user()->orders()->where('status', 1)->get();
        return view('home', compact('orders'));
    }
}
