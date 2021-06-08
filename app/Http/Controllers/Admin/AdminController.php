<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use App\Http\Requests\Auth\AdminRegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;
use Exception;

class AdminController extends Controller
{
    public function index() {
        return view('dashboard');
    }
    public function loginPage() {
        return view('auth.login');
    }

    public function registerPage() {
        return view('auth.register');
    }

    public function login(AdminLoginRequest $request) 
    {
        $username = $request->username;
        $password = $request->password;

        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            Auth::attempt(['email' => $username, 'password' => $password]);
        } else {
            Auth::attempt(['username' => $username, 'password' => $password]);
        }
        return Auth::check();

        if(Auth::check()) {
            Auth::user()->createToken('Crowns Pembeli')->accessToken;
            return route('dashboard');
        } else {
            return redirect()->back()->with('message', 'login gagal');
        }
    }

    public function register(AdminRegisterRequest $request)
    {
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'admin',
        ]);

        $id_user = User::latest()->first()->id;
        Admin::create([
            'id_user' => $id_user,
            'nama' => $request->nama
        ]);
        
        try{
            Auth::attempt(['email' => $request->username, 'password' => $request->password, 'role' => 'admin']);
        } catch (Exception $e) {
            return redirect()->back()->with('message', 'silakan login secara manual');
        }
        return route('landing');
    }
}
