<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembeliController extends APIController
{
    // Fungsi login untuk pembeli
    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        if(filter_var($username, FILTER_VALIDATE_EMAIL)) {
            Auth::attempt(['email' => $username, 'password' => $password, 'role' => 'pembeli']);
        } else {
            Auth::attempt(['username' => $username, 'password' => $password, 'role' => 'pembeli']);
        }

        if(Auth::check()) {
            $response['token'] = Auth::user()->createToken('Crowns Pembeli')->accessToken;

            return $this->sendResponse($response, 'Login berhasil');
        } else {
            return $this->sendError('Pembeli tidak ditemukan');
        }
    }
}
