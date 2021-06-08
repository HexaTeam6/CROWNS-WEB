<?php

namespace App\Http\Controllers\Admin\Penjahit;

use App\Http\Controllers\Controller;
use App\Http\Requests\Penjahit\PenjahitUpdateRequest;
use App\Models\Penjahit;
use App\Models\User;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function update($id)
    {
        $user = User::findOrFail($id);
        return view('profile', compact('user'));
    }
}
