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

    public function update(UserProfileRequest $request): JsonResponse
    {
        try{
            $userData = $request->validated();

            if ($request->hasFile('avatar')) {
                $userData['avatar'] = handleAttachmentUploading($request->file('avatar'));
            }

            $user = auth()->user();
            $user->update($userData);

            return  response()->json([
                'user' => new UserResource($user),
                'message' => 'Profile updated successfully'
            ], 200);
            
        }catch (\Exception $e){

            logError('Profile update failed', $e);        
            return  response()->json([
                'message' =>$e->getMessage()
            ], 500);

        }
    }
}
