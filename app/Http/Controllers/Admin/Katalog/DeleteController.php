<?php

namespace App\Http\Controllers\Admin\Katalog;

use App\Http\Controllers\Controller;
use App\Models\Baju;
use App\Models\Kategori;
use App\Models\MemilikiKatalog;
use Exception;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function deleteKategori(Request $request)
    {
        $kategori = Kategori::findOrFail($request->id);
        $bajus = Baju::where('id_kategori', $request->id)->get();
        try{
            foreach($bajus as $baju) {
                $memiliki_katalog = MemilikiKatalog::where('id_baju', $baju->id);
                foreach($memiliki_katalog as $memiliki) {
                    $memiliki->delete();
                }
                $memiliki_katalog->delete();
                $baju->delete();
            }
            $pesan = ['sukses', 'berhasil menghapus beserta kepemilikan'];
        } catch(Exception $e) {
            $pesan = ['gagal', 'katalog gagal terhapus'];
        }
        return redirect()->back();
    }
}
