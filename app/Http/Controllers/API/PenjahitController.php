<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PesananResource;
use App\Models\Penjahit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PenjahitController extends APIController
{
    // Fungsi login untuk penjahit
    // login bisa menggunakan email atau username
    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            Auth::attempt(['email' => $username, 'password' => $password, 'role' => 'penjahit']);
        } else {
            Auth::attempt(['username' => $username, 'password' => $password, 'role' => 'penjahit']);
        }

        if (Auth::check()) {
            $response['token'] = Auth::user()->createToken('Crowns Penjahit')->accessToken;
            $response['id_user'] = Auth::user()->id;

            return $this->sendResponse($response, 'Login berhasil');
        } else {
            return $this->sendError('Penjahit tidak ditemukan');
        }
    }

    // Fungsi mendaftar untuk penjahit
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
            'nama_rek' => 'required|string|max:255',
            'no_rekening' => 'required|numeric',
            'bank' => 'required|string|max:255',
            'kodepos' => 'required|numeric|digits_between:1,6',
            'kecamatan' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'alamat' => 'required|max:1024',
            'list_id_baju' => 'required|array',
            'list_id_baju.*.id_baju' => 'required|exists:baju,id'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validasi gagal', $validator->errors(), 400);
        }

        DB::beginTransaction();

        try {
            $inputUser = $request->only('username', 'email', 'password');
            $inputUser['role'] = 'penjahit';
            $inputUser['password'] = bcrypt($inputUser['password']);
            $user = User::create($inputUser);

            $inputPenjahit = $request->except('username', 'email', 'password', 'list_id_baju');
            $inputPenjahit['id_user'] = $user->id;
            $inputPenjahit['tanggal_lahir'] = Carbon::parse($inputPenjahit['tanggal_lahir'])->format('Y-m-d');
            $penjahit = Penjahit::create($inputPenjahit);

            $inputBaju = $request->list_id_baju;
            $penjahit->baju()->attach($inputBaju);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->sendError('Insert gagal',  $e->getMessage(), 500);
        }

        DB::commit();

        $response['token'] =  $user->createToken('Crowns Penjahit')->accessToken;
        $response['id_user'] = $user->id;
        return $this->sendResponse($response, 'Penjahit berhasil terdaftar');
    }

    // fungsi untuk mengambil profil penjahit
    // berdasarkan id user
    public function profileByUserId(Request $request)
    {
        $user = User::find($request->id_user);

        if (!$user || $user->role != 'penjahit') {
            return $this->sendError("penjahit tidak ditemukan");
        }

        $response = $user->penjahit;
        $response['username'] = $user->username;
        $response['email'] = $user->email;
        $response['katalog'] = $user->penjahit()->first()->baju;
        $response['rating'] = $user->penjahit()->first()->pesanan()->avg('rating');

        return $this->sendResponse($response, 'Profil penjahit berhasil diambil');
    }

        // fungsi untuk mengambil profil penjahit
    // berdasarkan id user
    public function profileByIdPenjahit(Request $request)
    {
        $penjahit = Penjahit::find($request->id_penjahit);

        if (!$penjahit) {
            return $this->sendError("penjahit tidak ditemukan");
        }

        $response = $penjahit;
        $response['username'] = $penjahit->user()->first()->username;
        $response['email'] = $penjahit->user()->first()->email;
        $response['katalog'] = $penjahit->baju()->get();
        $response['rating'] = $penjahit->pesanan()->avg('rating');

        return $this->sendResponse($response, 'Profil penjahit berhasil diambil');
    }

    // fungsi untuk mengambil histori pesanan selesai penjahit
    // berdasarkan id user
    public function pesananPenjahitByUserId(Request $request)
    {
        $user = User::find($request->id_user);

        if (!$user || $user->role != 'penjahit') {
            return $this->sendError("penjahit tidak ditemukan");
        }

        $pesanan = $user->penjahit->pesanan()
            ->where('status_pesanan', 5)->latest()->get();

        return $this->sendResponse(PesananResource::collection($pesanan), 'Histori pesanan selesai penjahit berhasil diambil');
    }

    // Fungsi untuk mengupdate profil penjahit
    public function updateProfil(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'sometimes|string|max:255',
            'jenis_kelamin' => 'sometimes|string|max:1',
            'no_hp' => 'sometimes|numeric|digits_between:1,16',
            'tanggal_lahir' => 'sometimes|date',
            'nama_rek' => 'sometimes|string|max:255',
            'no_rekening' => 'sometimes|numeric',
            'bank' => 'sometimes|string|max:255',
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

        if (isset($input['tanggal_lahir'])) {
            $input['tanggal_lahir'] = Carbon::parse($input['tanggal_lahir'])->format('Y-m-d');
        }

        $penjahit = Penjahit::where('id_user', $request->user()->id)->first();
        $penjahit->update($input);

        return $this->sendResponse($penjahit, 'Profil penjahit berhasil diupdate');
    }
}
