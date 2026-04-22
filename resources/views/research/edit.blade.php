@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">

    <h2 class="text-xl font-bold mb-4">Edit Research</h2>

    <!-- 🔥 VALIDATION ERRORS -->
    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
          action="{{ route('research.update',$research->id) }}"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <!-- TITLE -->
        <input type="text" name="title"
               value="{{ $research->title }}"
               class="w-full mb-2 p-2 border rounded">

        <!-- AUTHOR -->
        <input type="text" name="author"
               value="{{ $research->author }}"
               class="w-full mb-2 p-2 border rounded">

        <!-- YEAR -->
        <input type="number" name="year"
               value="{{ $research->year }}"
               class="w-full mb-2 p-2 border rounded">

        <!-- CATEGORY -->
        <input type="text" name="category"
               value="{{ $research->category }}"
               class="w-full mb-2 p-2 border rounded">

        <!-- ABSTRACT -->
        <textarea name="abstract"
                  class="w-full mb-2 p-2 border rounded"
                  rows="5">{{ $research->abstract }}</textarea>

        <!-- CURRENT FILE -->
        @if($research->file)
            <div class="mb-3 text-sm text-gray-600">
                📎 Current File:
                <a href="{{ asset('storage/' . $research->file) }}"
                   target="_blank"
                   class="text-blue-600 underline">
                    View PDF
                </a>
            </div>
        @endif

        <!-- UPLOAD NEW PDF -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Replace PDF File
            </label>

            <input type="file"
                   name="file"
                   accept="application/pdf"
                   class="w-full p-2 border rounded">
        </div>

        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Update Research
        </button>

    </form>

</div>

@endsection