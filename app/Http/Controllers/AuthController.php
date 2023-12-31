<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\ForgotFormRequest;
use App\Mail\ForgotPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Проверить и валидировать входные данные
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Создать нового пользователя
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        // Войти в систему автоматически после успешной регистрации (необязательно)
        auth()->login($user);

        // Перенаправить пользователя на нужную страницу
        return redirect()->route('home');
    }



    public function showLoginForm()
    {
        return view('auth.login');
    }



    public function login(Request $request)
    {
       $data =  $request->validate([
            'email' => 'required|string|email',
            'password' => 'required',
        ]);

        if (auth('web')->attempt($data)){
            return redirect()->route('home');
        }

        return redirect()->route('login')->withErrors(["email" => " Пользователь не найден, либо данные введены не правильно"]);
    }


    public function logout()
    {
        auth('web')->logout();
        return redirect('/');
    }


    public function showForgotForm()
    {
        return view('auth.forgot');
    }

    public function forgot(ForgotFormRequest $request)
    {
        $data = $request;
        $user = User::where(['email'=> $data['email']])->first();
        $password = uniqid();
        $user->password = bcrypt($password);
        $user->save();
        Mail::to($user)->send(new ForgotPassword($password));
        session()->flash('success', 'Ваш новый пароль отправлен на почту');
        return redirect(route('login'));
    }

}
