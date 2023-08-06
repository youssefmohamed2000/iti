@extends('layouts.index')

@section('content')
    <div class="my-5">
        <a href="{{ route('posts.create') }}"
           class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            Add Post
        </a>

    </div>

    <table class="w-full text-sm text-left text-gray-500 ">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
        <tr>
            <th scope="col" class="px-6 py-3">id</th>
            <th scope="col" class="px-6 py-3">title</th>
            <th scope="col" class="px-6 py-3">description</th>
            <th scope="col" class="px-6 py-3">user</th>
            <th scope="col" class="px-6 py-3">actions</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($posts as $post)
            <tr class="bg-white border-b">
                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                    {{ $post->id }}</td>
                <td class="px-6 py-4">{{ $post->title }}
                </td>
                <td class="px-6 py-4">
                    {{ $post->description }}
                </td>
                <td class="px-6 py-4">
                    {{ $post->user->name ?? '..' }}
                </td>
                <td class="flex gap-2 px-6 py-4 text-white">
                    <a class="p-1 rounded-md bg-yellow-600 hover:bg-yellow-700" href="{{ route('posts.show', $post->id) }}">view</a>
                    <a class="p-1 rounded-md bg-blue-600 hover:bg-blue-700" href="{{ route('posts.edit', $post->id) }}">edit</a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                        @csrf
                        @method('delete')

                        <button class="p-1 rounded-md bg-red-600 hover:bg-red-700">delete</button>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

@endsection
