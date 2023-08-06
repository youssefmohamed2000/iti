@extends('layouts.index')

@section('content')
    <h2 class="mb-5 text-lg font-semibold">Show Post :</h2>
    <ul class="max-w-md space-y-1  list-none list-inside ">
      <li>
            Title : {{ $post->title }}
        </li>
        <li>
            Description : {{ $post->description }}
        </li>

    </ul>
@endsection
