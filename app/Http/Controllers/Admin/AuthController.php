<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required',
        ]);

        // Проверяем, включена ли опция "Запомнить меня"
        $remember = $request->has('remember');

        if (auth('admin')->attempt($data, $remember)) {
            return redirect()->route('admin.main');
        }

        // Если вход не удался, добавляем уведомление об ошибке
        return redirect()->route('admin.login')->withErrors(["warning" => "Пользователь не найден, либо данные введены неверно"]);
    }

    public function logout()
    {
        auth('admin')->logout();
        return redirect()->route('admin.login');
    }
}

