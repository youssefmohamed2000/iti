<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|string|email|max:255|exists:users,email',
            'password' => 'required|string|max:255',
        ]);

        $validated = $request->validated();
        if (auth()->attempt([
            'email' => $validated['email'],
            'password' => $validated['password'],
        ])
        ) {
            $user = auth()->user();
            $data['user'] = new UserResource($user);
            $data['token'] = $user->createToken('my-app-token')->plainTextToken;

            return response()->json($data);
        }

        return response()->json([
            'message' => 'Auth failed',
            'error' => 'this credentials don\'t match our records',
        ]);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $validated = $request->safe();

        $validated = $validated->merge([
            'password' => Hash::make($validated['password']),
        ]);

        $user = User::query()->create($validated->toArray());
        $data['user'] = new UserResource($user);
        $data['token'] = $user->createToken('my-app-token')->plainTextToken;

        return response()->json($data);
    }
}
