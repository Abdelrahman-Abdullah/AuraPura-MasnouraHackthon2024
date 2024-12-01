<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\UserLoginRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserSessionController extends Controller
{
    public function login(UserLoginRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            // Attempt to authenticate the user with the credentials
            if (!Auth::attempt($credentials)) {
                return response()->json(['Invalid login credentials'],401);
            }

            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json(
                [
                    'message' => 'Login successful',
                    'user' => new UserResource($user),
                    'token' => $token
                ], 200
            );

        } catch (Exception $e) {
            Log::error('Login failed: '.$e->getMessage().' in '.$e->getFile().' on line '.$e->getLine().' with code '.$e->getCode());
            return response()->json(
                ['message' => 'Login failed. Please try again later.'],
                500
            );
        }
    }

    public function logout(Request $request)
    {
        try{
            $request->user()->tokens()->delete();
            return response()->json(
                [
                    'message' => 'Logout successfully'
                ], 200
            );
        }catch (Exception $e){
            Log::error('Logout failed: '.$e->getMessage().' in '.$e->getFile().' on line '.$e->getLine().' with code '.$e->getCode());
            return response()->json(
                ['message' => 'Logout failed. Please try again later.'],
                500
            );
        }
    }
}
