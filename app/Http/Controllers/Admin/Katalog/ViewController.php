<?php

namespace App\Http\Controllers\Admin\Katalog;

use App\Http\Controllers\Controller;
use App\Models\Baju;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function view () {
        $list_kategori = Kategori::all();
        $list_baju = Baju::all();
        return view('catalogue.index', compact(['list_kategori', 'list_baju']));
    }

    public function viewKategori($id) {
        $kategori = Kategori::findOrFail($id);
        return view('catalogue.kategori.edit', compact(['kategori']));
    }

    public function viewBaju ($id) {
        $baju = Baju::findOrFail($id);
        return view('catalogue.baju.edit', compact(['baju']));
    }
}
