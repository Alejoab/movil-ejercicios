<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PetsController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'message' => 'OK',
            'data' => Pet::query()->select(['id', 'name', 'age', 'type'])->get(),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'max:10', 'min:0'],
            'type' => ['required', 'in:CAT,DOG'],
        ]);

        $pet = Pet::query()->create($request->all());

        return response()->json([
            'message' => 'Pet created successfully',
            'data' => $pet
        ], 201);
    }

    public function show(Pet $pet): JsonResponse
    {
        return response()->json([
            'message' => 'OK',
            'data' => $pet,
        ]);
    }

    public function update(Request $request, Pet $pet): JsonResponse
    {
        $request->validate([
            'name' => ['string', 'max:255'],
            'age' => ['integer', 'max:10', 'min:0'],
            'type' => ['in:CAT,DOG'],
        ]);

        $pet->fill($request->all());
        $pet->save();

        return response()->json([
            'message' => 'Pet updated successfully',
            'data' => $pet
        ]);
    }

    public function destroy(Pet $pet): JsonResponse
    {
        $pet->delete();

        return response()->json([
           'message' => 'Pet deleted successfully'
        ]);
    }
}
