<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::all();

        return view('posts.index', compact('posts'));
    }

    public function create(): View
    {
        return view('posts.create');
    }

    public function store(PostStoreRequest $request): RedirectResponse
    {
        $validated = $request->safe();

        $validated = $validated->merge([
            'user_id' => $request->user()->id,
        ]);

        Post::query()->create($validated->toArray());

        return redirect()->route('posts.index');
    }

    public function show(Post $post): View
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post): View
    {
        return view('posts.edit', compact('post'));
    }

    public function update(
        PostUpdateRequest $request,
        Post $post
    ): RedirectResponse {
        $validated = $request->validated();

        $post->update($validated);

        return redirect()->route('posts.index');
    }

    public function destroy(string $id): RedirectResponse
    {
        $post = Post::query()->findOrFail($id);

        $post->delete();

        return redirect()->route('posts.index');
    }
}
