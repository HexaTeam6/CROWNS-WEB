<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
            'email' => 'required|email|max:50|unique:users',
            'password' => 'required|min:8',
            'nama' => 'required|max:50',
            'jenis_kelamin' => 'required|max:1',
            'no_hp' => 'required|numeric|digits_between:1,16',
            'tanggal_lahir' => 'required|date',
            'kodepos' => 'required|numeric|digits_between:1,6',
            'kecamatan' => 'required|max:20',
            'kota' => 'required|max:20',
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
    // berdasarkan id users
    public function profileByUsersId(Request $request)
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
}
