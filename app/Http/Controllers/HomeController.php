<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function home() {
        $orders = Auth::user()->orders()->active()->paginate(10);
        $wallets = Auth::user()->wallets()->paginate(10);
        return view('home', compact('orders', 'wallets'));
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
