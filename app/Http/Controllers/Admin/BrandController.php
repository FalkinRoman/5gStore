<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
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
            $brands = Brand::where('name', 'LIKE', '%' . $keyword . '%')->get();
        } else {
            $brands = Brand::all();
        }

        return view('admin.brands.brands', compact('brands', 'keyword'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()  //страница формы добавления бренда
    {
        return view('admin.brands.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)  //Процесс добавления новой формы
    {
        $params = $request->all();
        unset($params['image']);
        if ($request->has('image')){
            $path = $request->file('image')->store('brands');
            $params['image'] = $path;
        }
        Brand::create($params);
        return redirect() ->route('admin.brands.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand) //Страница определенного одного бренда
    {
        return view('admin.brands.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)  //страница для изменения существующего бренда(редактировать)
    {
        //тк похожа с добавлением новой категории испоьзуем его роут
        return view('admin.brands.form', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, Brand $brand) //Процесс редактирования данных
    {
        $params = $request->all();
        unset($params['image']);
        if ($request->has('image')) {
            Storage::delete($brand->image);
            $path = $request->file('image')->store('brands');
            $params['image'] = $path;
        }
        $brand->update($params);
        return redirect() ->route('admin.brands.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect() ->route('admin.brands.index');
    }
}
