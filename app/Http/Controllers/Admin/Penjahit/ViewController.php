<?php

namespace App\Http\Controllers\Admin\Penjahit;

use App\Http\Controllers\Controller;
use App\Models\User;

class ViewController extends Controller
{
    public function update($id)
    {
        $user = User::findOrFail($id);
        return view('accounts.profile', compact('user'));
    }
}
