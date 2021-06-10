<?php

namespace App\Http\Controllers\Admin\Konsumen;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Konsumen;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function updatePut(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $konsumen = Konsumen::findOrFail($user->konsumen->id);
        $konsumen->update([
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_rekening' => $request->no_rekening,
            'bank' => $request->bank,
            'kodepos' => $request->kodepos,
            'kecamatan' => $request->kecamatan,
            'kota' => $request->kota,
            'alamat' => $request->alamat
        ]);
        return view('accounts.profile', compact('user'));
    }
}
