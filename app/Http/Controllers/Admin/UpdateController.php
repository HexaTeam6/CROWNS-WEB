<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateController extends Controller
{
    public function updatePut(Request $request) 
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        $admin = Admin::findOrFail($user->admin->id);
        $admin->update([
            'nama' => $request->nama
        ]);
        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        return back()->with('success', 'edit success');
    }
}
