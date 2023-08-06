<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection(User::all());
    }

    public function update(UserUpdateRequest $request, User $user): UserResource
    {
        $validated = $request->safe();

        $validated['password'] = Hash::make($validated['password']);

        $user->update($validated);

        return new UserResource($user);
    }

    public function destroy(User $user): UserResource
    {
        $user->delete();

        return new UserResource($user);
    }
}
