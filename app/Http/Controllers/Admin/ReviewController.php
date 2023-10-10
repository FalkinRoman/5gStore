<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\ReviewRequest;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;


class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $reviewsQuery = Review::query();

        if (!empty($keyword)) {
            // Поиск по email пользователя
            $reviewsQuery->whereHas('user', function ($query) use ($keyword) {
                $query->where('email', 'LIKE', '%' . $keyword . '%');
            });

            // Поиск по названию продукта
            $reviewsQuery->orWhereHas('product', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%');
            });
        }

        $reviews = $reviewsQuery->get();

        return view('admin.reviews.reviews', compact('reviews', 'keyword'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all(); // Получаем список всех пользователей
        $products = Product::all(); // Получаем список всех продуктов

        return view('admin.reviews.form', compact('users', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewRequest $request)
    {
        $params = $request->validated();
        Review::create($params);
        return redirect()->route('admin.reviews.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review) //Страница определенного одного отзыва
    {
        return view('admin.reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        $users = User::all(); // Получаем список всех пользователей
        $products = Product::all(); // Получаем список всех продуктов

        return view('admin.reviews.form', compact('review', 'users', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(ReviewRequest $request, Review $review)
    {
        $params = $request->validated();
        $review->update($params);
        return redirect()->route('admin.reviews.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return redirect() ->route('admin.reviews.index');
    }
}
