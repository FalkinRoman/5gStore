<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
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
            $users = User::where(function($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('email', 'LIKE', '%' . $keyword . '%');
            })->get();
        } else {
            $users = User::all();
        }

        return view('admin.users.users', compact('users', 'keyword'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()  //страница формы добавления бренда
    {
        return view('admin.users.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(UserRequest $request) //новый пользователь
    {

        $params = $request->all();
        unset($params['image']);
        $params['password'] = bcrypt($request->input('password')); // Хешируем пароль

        if ($request->has('image')) {
            $path = $request->file('image')->store('users');
            $params['image'] = $path;
        }

        User::create($params);
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) //Страница определенного одного бренда
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)  //страница для изменения существующего пользователя(редактировать)
    {
        //тк похожа с добавлением новой категории испоьзуем его роут
        return view('admin.users.form', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $params = $request->all();

        unset($params['image']);

        // Проверяем правильность введенного старого пароля
        if ($request->has('old_password')) {
            if (!Hash::check($request->input('old_password'), $user->password)) {
                throw ValidationException::withMessages([
                    'old_password' => ['Неверный старый пароль'],
                ]);
            }
        }

        if ($request->has('password')) {
            $params['password'] = bcrypt($request->input('password')); // Хешируем новый пароль
        }

        if ($request->has('image')) {
            Storage::delete($user->image);
            $path = $request->file('image')->store('users');
            $params['image'] = $path;
        }

        $user->update($params);
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect() ->route('admin.users.index');
    }
}
