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
            return response()->json([
                'message' => 'Verify Your Email!',
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => $e->errors()], 400);
        }
    }

}
