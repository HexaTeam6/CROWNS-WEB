<?php

namespace App\Http\Controllers\Admin\Konsumen;

use App\Http\Controllers\Controller;
use App\Models\Konsumen;
use App\Models\User;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function delete(Request $request)
    {
        $user = User::findOrFail($request->id);
        $konsumen = Konsumen::findOrFail($request->id_konsumen);
        $konsumen->delete();
        $user->delete();
        return redirect()->back();
    }
}
