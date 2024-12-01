<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle(GoogleLoginRequest $request)
    {
        try {
            $googleAuthUser = Socialite::driver('google')->stateless()->userFromToken(
                $request->validated('accessToken')
            );
            if (!$googleAuthUser) {
                return  response()->json([
                    'message' => 'Invalid Google Token'
                ], 422);
            }

            $userFromDB = DB::transaction(function () use ($googleAuthUser) {

                $user = User::firstOrCreate(
                    ['email' => $googleAuthUser->email],
                    [
                        'email_verified_at' => now(),
                        'first_name' => $googleAuthUser->name,
                        'last_name' => strtolower($googleAuthUser->offsetGet('given_name')),
                        'email' => $googleAuthUser->email,
                        'password' => bcrypt(rand(100000, 999999)),
                    ]
                );
                $user->tokens()->delete();
                return $user;
            });

            $token = $userFromDB->createToken('authToken')->plainTextToken;
            return  response()->json([
                'message' => 'Login successfully',
                'user' => $userFromDB,
                'token' => $token
            ], 200, $headers);

        } catch (\Exception $e) {

            Log::error('Failed to create user: '.$e->getMessage().' in '.$e->getFile().' on line '.$e->getLine().' with code '.$e->getCode());
            return  response()->json([
                'message' => 'Failed to login with Google'
            ], 200);
        
        }


    }
}
