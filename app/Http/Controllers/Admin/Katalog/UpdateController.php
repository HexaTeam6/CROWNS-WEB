<?php

namespace App\Http\Controllers\Admin\Katalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Katalog\StoreBajuRequest;
use App\Models\Baju;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function updatePutBaju (StoreBajuRequest $request, $id) {
        $baju = Baju::findOrFail($request->id);
        $image = $request->image;
        dd($image);

        if ($image !== null) {
            Storage::delete(public_path() . '/gallery/images/' . $baju->foto);
            $image_name = 'foto' . '-' . $id . 'png';
            $image_name = str_replace(' ', '-', strtolower($image_name));
            $image->storeAs('images', $image_name);
            $image->move(public_path('/gallery/images'.$image_name));
            $baju->update([
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'deskripsi' => $request->deskripsi,
                'foto' => $image_name
            ]);
        }
        $baju->update([
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'deskripsi' => $request->deskripsi,
            'foto' => null
        ]);
        
        
        return redirect()->back();
    }

}
