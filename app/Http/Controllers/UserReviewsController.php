<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class UserReviewsController extends Controller  //создание отзывы и рейтинга пользователем (маршруты в web)
{
    public function create(Product $product)
    {
        return view('user_reviews.create', compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'comment' => 'required|string',
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        // Проверяем, оставлял ли пользователь отзыв для данного продукта
        $existingReview = Review::where('user_id', auth()->id())->where('product_id', $product->id)->first();

        if ($existingReview) {
            return redirect()->back()->with('error', 'Вы уже оставили отзыв для этого продукта.');
        }

        $review = new Review([
            'comment' => $request->input('comment'),
            'rating' => $request->input('rating'),
        ]);

        $product->reviews()->save($review);

        $product->rating = $product->reviews()->avg('rating');
        $product->save();

        return redirect()->back()->with('success', 'Отзыв успешно добавлен');
    }
}
