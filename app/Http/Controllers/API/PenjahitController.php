<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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

        if(filter_var($username, FILTER_VALIDATE_EMAIL)) {
            Auth::attempt(['email' => $username, 'password' => $password, 'role' => 'penjahit']);
        } else {
            Auth::attempt(['username' => $username, 'password' => $password, 'role' => 'penjahit']);
        }

        if(Auth::check()) {
            $response['token'] = Auth::user()->createToken('Crowns Penjahit')->accessToken;

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
            'email' => 'required|email|max:50|unique:users',
            'password' => 'required|min:8',
            'nama' => 'required|max:50',
            'jenis_kelamin' => 'required|max:1',
            'no_hp' => 'required|numeric|digits_between:1,16',
            'tanggal_lahir' => 'required|date',
            'no_rekening' => 'required|numeric',
            'bank' => 'required',
            'kodepos' => 'required|numeric|digits_between:1,6',
            'kecamatan' => 'required|max:20',
            'kota' => 'required|max:20',
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

            $inputPenjahit = $request->except('username', 'email', 'password', 'list_jam_buka', 'list_id_baju');
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
        return $this->sendResponse($response, 'Penjahit berhasil terdaftar');
        
    }
}