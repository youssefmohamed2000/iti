<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserStoreRequest;
use App\Http\Requests\Api\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection(User::all());
    }

    public function update(UserUpdateRequest $request, User $user): UserResource
    {
        $validated = $request->validated();

        $user->update($validated);

        return new UserResource($user);
    }

    public function destroy(User $user): UserResource
    {
        $user->delete();

        return new UserResource($user);
    }
}
