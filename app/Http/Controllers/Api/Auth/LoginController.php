<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class LoginController extends Controller
{
    public function login(Request $request){

        $cred = $request->only(['email','password']);

        $token = auth()->attempt($cred);

        return resoponse()->json{['token' => $token]};

    }
}
