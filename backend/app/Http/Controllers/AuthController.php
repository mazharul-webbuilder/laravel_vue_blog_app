<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Login manage
     */
    public function login(LoginRequest $request)
    {
        try {
            $credential = $request->validated();
            if (Auth::attempt($credential)){
                $user = Auth::user();
                $token = $user->createToken('access_token')->plainTextToken;
            } else{
                return response()->json([
                   'message'=> 'Credential not matched'
                ]);
            }

            return response()->json([
                'status' => true,
                'user' => $user,
                'accessToken' => $token,
            ]);
        } catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * Logout
    */
    public function logout()
    {

    }
}
