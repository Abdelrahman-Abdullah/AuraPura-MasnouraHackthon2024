<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UserRegisterController extends Controller
{
    public function __invoke(UserRegisterRequest $request)
    {
        try {
              User::create($request->validated());
              $this->generateAndSendOtp($request->email);
            return response()->json([
                'message' => 'Verify Your Email!',
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => $e->errors()], 400);
        }
    }

    public function generateAndSendOtp($email)
    {
        // Generate an OTP
        $otp = random_int(10000, 99999);

        // Insert Otp code in otp table
        DB::table('otp')
            ->insert([
                'email' => $email,
                'otp' => $otp,
                'expires_at' => now()->addMinutes(5),
            ]);

        // Send OTP via email (you can use any mail implementation here)
        Mail::to($email)->send(new \App\Mail\VerifyEmail($otp,5));
    }

}
