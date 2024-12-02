<?php

namespace App\Http\Controllers\API\v1;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\TestStoreRequest;

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
