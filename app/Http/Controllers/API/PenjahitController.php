<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}