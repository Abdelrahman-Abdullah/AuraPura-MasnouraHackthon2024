<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function store(TestStoreRequest $request)
    {
        try
        {
            auth()->user()->progress()->create($request->validated());

            return response()->json([
                'message' => 'Test Saved Successful',
            ], 201);

        } catch(\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ],500);

        }

    }
}
