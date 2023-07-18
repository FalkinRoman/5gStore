<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home() {
        $orders = Auth::user()->orders()->where('status', 1)->get();
        return view('home', compact('orders'));
    }

    public function show($orderId) {
        $user = Auth::user();
        $order = $user->orders()->where('id', $orderId)->first();

        if (!$order) {
            return abort(404);
        }
        if ($order->user_id !== $user->id) {
            return abort(404);
        }

        return view('person.orders.show', compact('order'));

    }
}
