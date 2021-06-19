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
    protected $pesan;

    public function setPesan($pesan) {
        $this->pesan = $pesan;
    }
    
    public function getPesan() {
        return $this->pesan;
    }

    protected function deleteBajuUtil($id)
    {
        $baju = Baju::findOrFail($id);
        $memiliki_katalog = MemilikiKatalog::where('id_baju', $baju->id);
        $memiliki_katalog->delete();
        $baju->delete();
        return 0;
    }

    public function deleteKategori(Request $request)
    {
        $kategori = Kategori::findOrFail($request->id);
        try{
            $bajus = Baju::where('id_kategori', $kategori->id)->get();
            foreach($bajus as $baju) {
                $this->deleteBajuUtil($baju->id);
            }
            $kategori->delete();
            $this->setPesan(['success', 'berhasil menghapus beserta kepemilikan']);
        } catch(Exception $e) {
            $this->setPesan(['gagal', $e->getMessage()]);
        }
        $pesan = $this->getPesan();
        return redirect()->back()->with($pesan[0], $pesan[1]);
    }

    public function deleteBaju(Request $request)
    {
        try{
            $this->deleteBajuUtil($request->id);
            $this->setPesan(['success', 'berhasil dihapus']);
        } catch(Exception $e) {
            $this->setPesan(['gagal', $e->getMessage()]);
        }
        $pesan = $this->getPesan();
        return redirect()->back()->with($pesan[0], $pesan[1]);
    }
}
