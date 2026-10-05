<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);

        $users = session()->get('registered_users', [
            'ahmet@example.com' => [
                'name' => 'Ahmet Yılmaz',
                'email' => 'ahmet@example.com',
                'password' => '123456'
            ]
        ]);

        if (isset($users[$request->email]) && $users[$request->email]['password'] === $request->password) {
            session()->put('user', $users[$request->email]);
            session()->save();
            return redirect()->route('products.index');
        }

        return redirect()->back()->with('error', 'E-posta veya şifre hatalı!');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);

        $users = session()->get('registered_users', []);

        if (isset($users[$request->email])) {
            return redirect()->back()->with('error', 'Bu e-posta adresi zaten kayıtlı!');
        }

        $newUser = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ];

        $users[$request->email] = $newUser;
        session()->put('registered_users', $users);
        session()->put('user', $newUser);
        session()->save();

        return redirect()->route('products.index');
    }

    public function logout()
    {
        session()->forget('user');
        session()->save();
        return redirect()->route('products.index');
    }

    public function profile()
    {
        $user = session()->get('user');

        if (!$user) {
            return redirect()->route('login');
        }

        $allOrders = session()->get('orders', []);
        
        // Giriş yapan kullanıcının e-postasına ait siparişleri filtrele
        $userOrders = array_filter($allOrders, function ($order) use ($user) {
            return isset($order['email']) && strtolower($order['email']) === strtolower($user['email']);
        });

        return view('auth.profile', compact('user', 'userOrders'));
    }
}