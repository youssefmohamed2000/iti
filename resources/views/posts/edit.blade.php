@extends('layouts.index')

@section('content')
    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('put')
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">title</label>
                        <div class="mt-2">
                            <input type="text" name="title" value="{{ $post->title }}" id="first-name"
                                   class="block ps-3 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('title')
                            <span class="text-red-500 text-sm font-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="last-name"
                               class="block text-sm font-medium leading-6 text-gray-900">description</label>
                        <div class="mt-2">
                            <input type="text" name="description" id="last-name" value="{{ $post->description }}"
                                   class="block ps-3 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('description')
                            <span class="text-red-500 text-sm font-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="reset" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
            <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Update
            </button>
        </div>
    </form>
@endsection
