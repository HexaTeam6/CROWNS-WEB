<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PesananResource;
use App\Models\Konsumen;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PembeliController extends APIController
{
    // Fungsi login untuk pembeli
    // login bisa menggunakan email atau username
    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            Auth::attempt(['email' => $username, 'password' => $password, 'role' => 'pembeli']);
        } else {
            Auth::attempt(['username' => $username, 'password' => $password, 'role' => 'pembeli']);
        }

        if (Auth::check()) {
            $response['token'] = Auth::user()->createToken('Crowns Pembeli')->accessToken;
            $response['id_user'] = Auth::user()->id;

            return $this->sendResponse($response, 'Login berhasil');
        } else {
            return $this->sendError('Pembeli tidak ditemukan');
        }
    }

    // Fungsi mendaftar untuk pembeli
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:30|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:1',
            'no_hp' => 'required|numeric|digits_between:1,16',
            'tanggal_lahir' => 'required|date',
            'kodepos' => 'required|numeric|digits_between:1,6',
            'kecamatan' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'alamat' => 'required|max:1024'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validasi gagal', $validator->errors(), 400);
        }

        DB::beginTransaction();

        try {
            $inputUser = $request->only('username', 'email', 'password');
            $inputUser['role'] = 'pembeli';
            $inputUser['password'] = bcrypt($inputUser['password']);
            $user = User::create($inputUser);

            $inputPembeli = $request->except('username', 'email', 'password');
            $inputPembeli['id_user'] = $user->id;
            $inputPembeli['tanggal_lahir'] = Carbon::parse($inputPembeli['tanggal_lahir'])->format('Y-m-d');
            $pembeli = Konsumen::create($inputPembeli);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->sendError('Insert gagal',  $e->getMessage(), 500);
        }
        
        DB::commit();

        $response['token'] =  $user->createToken('Crowns Pembeli')->accessToken;
        $response['id_user'] = $user->id;
        return $this->sendResponse($response, 'Pembeli berhasil terdaftar');
    }

    // fungsi untuk mengambil profil pembeli
    // berdasarkan id user
    public function profileByUserId(Request $request)
    {
        $user = User::find($request->id_user);

        if(!$user || $user->role != 'pembeli') {
            return $this->sendError("Pembeli tidak ditemukan");
        }

        $response = $user->konsumen;
        $response['username'] = $user->username;
        $response['email'] = $user->email;

        return $this->sendResponse($response, 'Profil pembeli berhasil diambil');
    }

    // fungsi untuk mengambil profil pembeli
    // berdasarkan id pembeli
    public function profileByIdPembeli(Request $request)
    {
        $pembeli = Konsumen::find($request->id_pembeli);

        if(!$pembeli) {
            return $this->sendError("Pembeli tidak ditemukan");
        }

        $response = $pembeli;
        $response['username'] = $pembeli->user()->first()->username;
        $response['email'] = $pembeli->user()->first()->email;

        return $this->sendResponse($response, 'Profil pembeli berhasil diambil');
    }

    // fungsi untuk mengambil histori pesanan selesai pembeli
    // berdasarkan id user
    public function pesananPembeliByUserId(Request $request)
    {
        $user = User::find($request->id_user);

        if(!$user || $user->role != 'pembeli') {
            return $this->sendError("Pembeli tidak ditemukan");
        }

        $pesanan = $user->konsumen->pesanan()
                    ->where('status_pesanan', 5)->latest()->get();

        return $this->sendResponse(PesananResource::collection($pesanan), 'Histori pesanan selesai pembeli berhasil diambil');
    }

    // Fungsi untuk mengupdate profil pembeli
    public function updateProfil(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'sometimes|string|max:255',
            'jenis_kelamin' => 'sometimes|string|max:1',
            'no_hp' => 'sometimes|numeric|digits_between:1,16',
            'tanggal_lahir' => 'sometimes|date',
            'kodepos' => 'sometimes|numeric|digits_between:1,6',
            'kecamatan' => 'sometimes|string|max:255',
            'kota' => 'sometimes|string|max:255',
            'provinsi' => 'sometimes|string|max:255',
            'alamat' => 'sometimes|max:1024'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validasi gagal', $validator->errors(), 400);
        }

        $input = $request->all();

        if(isset($input['tanggal_lahir'])) {
            $input['tanggal_lahir'] = Carbon::parse($input['tanggal_lahir'])->format('Y-m-d');
        }

        $konsumen = Konsumen::where('id_user', $request->user()->id)->first();
        $konsumen->update($input);

        return $this->sendResponse($konsumen, 'Profil pembeli berhasil diupdate');
    }

}
