<?php

namespace App\Http\Controllers\Admin\Penjahit;

use App\Http\Controllers\Controller;
use App\Models\MemilikiKatalog;
use App\Models\Penjahit;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function delete(Request $request)
    {
        $user = User::findOrFail($request->id);
        $penjahit = Penjahit::findOrFail($request->id_penjahit);
        try {
            $katalogs = MemilikiKatalog::where('id_penjahit', $penjahit->id)->get();
            foreach($katalogs as $katalog) {
                $katalog->delete();
            }
            $pesan = ['sukses', 'berhasil menghapus beserta katalog penjahit'];
        } catch (Exception $e) {
            $pesan = ['gagal', 'katalog gagal terhapus'];
        }
        $penjahit->delete();
        $user->delete();
        return redirect()->back()->with($pesan[0], $pesan[1]);
    }
}
