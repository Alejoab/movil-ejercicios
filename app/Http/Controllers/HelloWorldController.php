<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class HelloWorldController extends Controller
{
    public function helloWorld(): JsonResponse
    {
        return response()->json([
            'message' => 'OK',
            'data' => [
                'name' => 'Alejandro Alvarez Botero'
            ]
        ]);
    }
}
