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

    public function logout(Request $request) 
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
