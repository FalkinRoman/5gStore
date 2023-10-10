<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CashbackHistory;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function main() {
        //кол-во польщователей для главной страницы
        $userCount = User::count();
        $productCount = Product::count();
        $orderCount = Order::active()->count();
        $reviewCount = Review::count();
        return view('admin.main.index', compact('userCount', 'productCount', 'orderCount', 'reviewCount'));
    }
    public function orders() {
        $orders = Order::active()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order) {
        $products = $order->products()->withTrashed()->get();   //ищем все продукты но также и удаленные файлы забираем
        return view('admin.orders.show', compact('order', 'products'));
    }



    public function confirmOrderCashback($orderId) //потверждение заказа админом на начисление крипты
  {
      if (!$orderId) {
          return back()->with('warning', 'Заказ не найден.');
      }

      $user = Auth::user();
      if (!$user) {
          return back()->with('warning', 'Пользователь не авторизован.');
      }

      $order = Order::find($orderId);

      if (!$order) {
          return back()->with('warning', 'Заказ не найден.');
      }

      $orderUser = $order->user_id;

      if (!$orderUser) {
          return back()->with('warning', 'Пользователь для данного заказа не найден.');
      }

      // Проверяем, был ли уже начислен кэшбэк для данного заказа
      $cashbackAlreadyAdded = CashbackHistory::where('user_id', $orderUser)
          ->where('order_id', $orderId)
          ->exists();

      if ($cashbackAlreadyAdded) {
          return back()->with('warning', 'Кэшбэк для данного заказа уже был начислен.');
      }

      $cryptoSumArray = $order->calculateTotalSumForCrypto();

      foreach ($cryptoSumArray as $cryptoSymbol => $cryptoData) {
          $wallet = Wallet::updateOrCreate(
              [
                  'user_id' => $orderUser,
                  'cryptocurrency_id' => $cryptoData['cryptocurrency_id'],
              ],
              [
                  'balance' => DB::raw("balance + {$cryptoData['totalSum']}"),
              ]
          );
      }

      // Сохраняем информацию о начисленном кэшбэке в отдельной таблице
      CashbackHistory::create([
          'user_id' => $orderUser,
          'order_id' => $orderId,
      ]);

      return back()->with('success', 'Заказ подтвержден, и кэшбэк начислен.');
  }





}
