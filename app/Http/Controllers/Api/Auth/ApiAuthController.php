<?php

namespace App\Http\Controllers\Api\Auth;

use App\Driver;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiAuthController extends Controller
{
    public function login(Request $request){

        $cred = $request->only(['email','password']);

//        $token = auth()->attempt($cred);

        if (!$token = auth()->attempt($cred)){
            return response()->json(['error'=>'Incorrect Email or Password'],401);
        }

//        return resoponse()->json{['token' => $token]};
        return response()->json([
            'token' => $token,
            'user' => auth()->user()
        ]);
    }


    public function register(Request $request)
    {
        return response()->json(['user' => Driver::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ])
        ]);
    }

    public function logout(Request $request)
    {
        /*$this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }*/
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);

    }

    public function getAuthUser(Request $request)
    {
        try {
            $this->validate($request, [
                'token' => 'required'
            ]);
        } catch (ValidationException $e) {
        }

        $user = JWTAuth::authenticate($request->token);

//        $user = auth()->user();

        return response()->json(['user' => $user]);
    }

}
