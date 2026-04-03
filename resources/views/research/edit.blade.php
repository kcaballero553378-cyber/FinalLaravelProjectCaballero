@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">

    <h2 class="text-xl font-bold mb-4">Edit Research</h2>

    <form method="POST" action="{{ route('research.update',$research->id) }}">
        @csrf
        @method('PUT')

        <input type="text" name="title" value="{{ $research->title }}" class="w-full mb-2 p-2 border">
        <input type="text" name="author" value="{{ $research->author }}" class="w-full mb-2 p-2 border">
        <input type="text" name="year" value="{{ $research->year }}" class="w-full mb-2 p-2 border">
        <input type="text" name="category" value="{{ $research->category }}" class="w-full mb-2 p-2 border">

        <textarea name="abstract" class="w-full mb-2 p-2 border">{{ $research->abstract }}</textarea>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">
            Update
        </button>
    </form>

</div>

@endsection