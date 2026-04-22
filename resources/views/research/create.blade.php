@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-100 py-12">

    <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-md border p-10">

        <h2 class="text-3xl font-bold text-gray-800 mb-6">
            Add Research
        </h2>

        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg">

                <strong>Please input the following fields:</strong>

                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>
        @endif

        <!-- 🔥 IMPORTANT: enctype ADDED -->
        <form method="POST"
              action="{{ route('research.store') }}"
              enctype="multipart/form-data"
              class="space-y-4">

            @csrf

            <!-- TITLE -->
            <div>
                <label class="text-sm text-gray-600">Title</label>
                <input type="text" name="title"
                       value="{{ old('title') }}"
                       class="w-full mt-1 p-3 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none"
                       placeholder="Enter research title">
            </div>

            <!-- AUTHOR -->
            <div>
                <label class="text-sm text-gray-600">Author</label>
                <input type="text" name="author"
                       value="{{ old('author') }}"
                       class="w-full mt-1 p-3 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none"
                       placeholder="Enter author name">
            </div>

            <!-- YEAR -->
            <div>
                <label class="text-sm text-gray-600">Year</label>
                <input type="text" name="year"
                       value="{{ old('year') }}"
                       class="w-full mt-1 p-3 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none"
                       placeholder="e.g. 2026">
            </div>

            <!-- CATEGORY -->
            <div>
                <label class="text-sm text-gray-600">Category</label>
                <input type="text" name="category"
                       value="{{ old('category') }}"
                       class="w-full mt-1 p-3 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none"
                       placeholder="e.g. Education, IT, Science">
            </div>

            <!-- ABSTRACT -->
            <div>
                <label class="text-sm text-gray-600">Abstract</label>
                <textarea name="abstract" rows="5"
                          class="w-full mt-1 p-3 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none"
                          placeholder="Enter research abstract">{{ old('abstract') }}</textarea>
            </div>

            <!-- 🔥 FILE UPLOAD ADDED -->
            <div>
                <label class="text-sm text-gray-600">Upload PDF (optional)</label>
                <input type="file" name="file" accept="application/pdf"
                       class="w-full mt-1 p-3 border rounded-lg bg-gray-50">
            </div>

            <!-- SUBMIT -->
            <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold transition">
                Save Research
            </button>

        </form>

    </div>

</div>

@endsection