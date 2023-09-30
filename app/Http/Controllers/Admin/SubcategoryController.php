<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SubcategoryRequest;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        if (!empty($keyword)) {
            $subcategories = Subcategory::where('name', 'LIKE', '%' . $keyword . '%')->get();
        } else {
            $subcategories = Subcategory::all();
        }

        $categories = Category::get();

        return view('admin.subcategories.subcategories', compact('subcategories', 'categories', 'keyword'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()  //страница формы добавления бренда
    {
        $categories = Category::get();
        return view('admin.subcategories.form', compact( 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubcategoryRequest $request)  //Процесс добавления новой формы
    {
        $params = $request->all();
        unset($params['image']);
        if ($request->has('image')){
            $path = $request->file('image')->store('subcategories');
            $params['image'] = $path;
        }
        $params['category_id'] = $request->input('category_id');
        Subcategory::create($params);
        return redirect() ->route('admin.subcategories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategory) //Страница определенного одной подкатегории
    {
        return view('admin.subcategories.show', compact('subcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategory)  //страница для изменения существующей подкатегории(редактировать)
    {
        $categories = Category::get();
        //тк похожа с добавлением новой категории испоьзуем его роут
        return view('admin.subcategories.form', compact('subcategory','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(SubcategoryRequest $request, Subcategory $subcategory) //процесс редактирования данных
    {
        $params = $request->all();
        unset($params['image']);

        if ($request->has('image')) {
            Storage::delete($subcategory->image);
            $path = $request->file('image')->store('subcategories');
            $params['image'] = $path;
        }

        // Добавляем категорию к параметрам перед обновлением подкатегории
        $params['category_id'] = $request->input('category_id');

        $subcategory->update($params);

        return redirect()->route('admin.subcategories.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return redirect() ->route('admin.subcategories.index');
    }
}
