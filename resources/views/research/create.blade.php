@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">

    <h2 class="text-xl font-bold mb-4">Add Research</h2>

    <form method="POST" action="{{ route('research.store') }}">
        @csrf

        <input type="text" name="title" placeholder="Title" class="w-full mb-2 p-2 border">
        <input type="text" name="author" placeholder="Author" class="w-full mb-2 p-2 border">
        <input type="text" name="year" placeholder="Year" class="w-full mb-2 p-2 border">
        <input type="text" name="category" placeholder="Category" class="w-full mb-2 p-2 border">

        <textarea name="abstract" placeholder="Abstract" class="w-full mb-2 p-2 border"></textarea>

        <button class="bg-green-500 text-white px-4 py-2 rounded">
            Save
        </button>
    </form>

</div>

@endsection