<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\VerifyEmailRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VerifyEmailController extends Controller
{
    public function verifyEmail(VerifyEmailRequest $request)
    {
        $email = $request->email;
        $otp = $request->otp;

        try {
            if ( !$this->checkIfTheMailHasOTPStillValid($email, $otp) ) {
                return response()->json(
                    [
                        'message' => 'Invalid or expired OTP. Please request a new OTP.',
                    ],401
                );
            }
            User::updateOrCreate(
                ['email' => $email],
                ['email_verified_at' => Carbon::now()]
            );
            DB::table('otp')->where('email', $email)->delete();

        } catch (\Exception $e) {
            Log::error('Failed to validate OTP: ' . $e->getMessage());
            return response()->json(
                ['message' => 'Invalid or expired OTP. Please request a new OTP.'],
                401 );
        }
    }

    private function checkIfTheMailHasOTPStillValid(string $email, ?string $otp = null): bool
    {
        $query = DB::table('otp')->where('email', $email);

        if ($otp !== null) {
            $query->where('otp', $otp);
        }

        $otpData = $query->first(['expires_at']);

        if (!$otpData) {
            return false;
        }

        return Carbon::now()->isBefore($otpData->expires_at);

    }
}
