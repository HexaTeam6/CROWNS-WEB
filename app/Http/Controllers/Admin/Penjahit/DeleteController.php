<?php

namespace App\Http\Controllers\Admin\Penjahit;

use App\Http\Controllers\Controller;
use App\Models\Penjahit;
use App\Models\User;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function delete(Request $request)
    {
        $user = User::findOrFail($request->id);
        $penjahit = Penjahit::findOrFail($request->id_penjahit);
        $penjahit->delete();
        $user->delete();
        return redirect()->route('dashboard');
    }
}
