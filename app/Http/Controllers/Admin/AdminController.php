<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use App\Http\Requests\Auth\AdminRegisterRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class AdminController extends Controller
{
    public function index() {
        return view('dashboard');
    }
    public function table() {
        $user = User::all();
        return view('accounts.index', ['users' => $user]);
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

        if(Auth::check()) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('message', 'login gagal');
        }
    }

    public function register(AdminRegisterRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'admin',
            ]);
            Admin::create([
                'id_user' => $user->id,
                'nama' => $request->nama
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error, register gagal');
        }
        DB::commit();
        
        try{
            Auth::attempt(['username' => $request->username, 'password' => $request->password]);
            if(Auth::check()) 
                return view('dashboard');
            else
                return redirect()->back()->with('message', 'silakan login secara manual');
        } catch (Exception $e) {
            return redirect()->back()->with('message', 'silakan login secara manual');
        }
    }

    public function logout(Request $request) 
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
