<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CryptocurrencyRequest;
use App\Models\Cryptocurrency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CryptocurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() ////страница криптовалюты
    {
        $cryptocurrencies = Cryptocurrency::get();
        return view('admin.cryptocurrencies.cryptocurrencies', compact('cryptocurrencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //страница формы добавления криптовалюты
    {
        return view('admin.cryptocurrencies.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CryptocurrencyRequest $request) //Процесс добавления новой криптовалюты
    {
        $params = $request->all();
        unset($params['image']);
        if ($request->has('image')){
            $path = $request->file('image')->store('cryptocurrencies');
            $params['image'] = $path;
        }
        Cryptocurrency::create($params);
        return redirect() ->route('admin.cryptocurrencies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cryptocurrency $cryptocurrency) //страница для изменения существующей криптовалюты(редактировать)
    {
        return view('admin.cryptocurrencies.form', compact('cryptocurrency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CryptocurrencyRequest $request, Cryptocurrency $cryptocurrency) //Процесс редактирования данных
    {
        $params = $request->all();
        unset($params['image']);
        if ($request->has('image')) {
            Storage::delete($cryptocurrency->image);
            $path = $request->file('image')->store('cryptocurrencies');
            $params['image'] = $path;
        }
        $cryptocurrency->update($params);
        return redirect() ->route('admin.cryptocurrencies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cryptocurrency $cryptocurrency)
    {
        $cryptocurrency->delete();
        return redirect() ->route('admin.cryptocurrencies.index');
    }
}
