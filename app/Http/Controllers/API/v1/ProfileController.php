<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(): JsonResponse
    {
        try{
            return  response()->json([
                'user' => new UserResource($user),
                'message' => 'Successfully fetched user profile',
            ], 200);

        }catch (\Exception $e){
            return  response()->json([
                'message' => $e->getMessage()
            ], 500);

        }
    }
}
