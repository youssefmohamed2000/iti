<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return PostResource::collection(Post::all());
    }

    public function store(PostStoreRequest $request): PostResource
    {
        $validated = $request->safe();

        $validated = $validated->merge([
            'user_id' => $request->user()->id,
        ]);

        $post = Post::query()->create($validated->toArray());

        return new PostResource($post);
    }

    public function update(PostUpdateRequest $request, Post $post): PostResource
    {
        $validated = $request->validated();

        $post->update($validated);

        return new PostResource($post);
    }

    public function destroy(Post $post): PostResource
    {
        $post->delete();

        return new PostResource($post);
    }
}
