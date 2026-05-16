@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">

    <h2 class="text-xl font-bold mb-4">Edit Research</h2>

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
          action="{{ route('research.update', $research->id) }}"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <!-- TITLE -->
        <input type="text" name="title"
               value="{{ old('title', $research->title) }}"
               class="w-full mb-2 p-2 border rounded">

        <!-- AUTHOR -->
        <input type="text" name="author"
               value="{{ old('author', $research->author) }}"
               class="w-full mb-2 p-2 border rounded">

        <!-- YEAR DROPDOWN -->
        <div class="mb-2">
            <input type="hidden" name="year" id="yearInput"
                   value="{{ old('year', $research->year) }}">
            <div class="relative" id="yearDropdown">
                <button type="button"
                        onclick="toggleYearDropdown()"
                        class="w-full p-2 border rounded bg-white text-left flex justify-between items-center">
                    <span id="yearLabel">
                        {{ old('year', $research->year) ?? '-- Select a Year --' }}
                    </span>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div id="yearList"
                     class="hidden absolute z-50 w-full bg-white border rounded shadow-lg mt-1 max-h-60 overflow-y-auto">
                    @php
                        $years = range(date('Y'), 2000);
                        $currentYear = old('year', $research->year);
                    @endphp
                    @foreach($years as $year)
                        <div onclick="selectYear('{{ $year }}')"
                             class="px-4 py-2 hover:bg-blue-50 cursor-pointer text-sm text-gray-700
                             {{ $currentYear == $year ? 'bg-blue-50 font-semibold' : '' }}">
                            {{ $year }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- CATEGORY CUSTOM DROPDOWN -->
        <div class="mb-2">
            <input type="hidden" name="category" id="categoryInput"
                   value="{{ old('category', $research->category) }}">
            <div class="relative" id="categoryDropdown">
                <button type="button"
                        onclick="toggleCategoryDropdown()"
                        class="w-full p-2 border rounded bg-white text-left flex justify-between items-center">
                    <span id="categoryLabel">
                        {{ old('category', $research->category) ? ucwords(old('category', $research->category)) : '-- Select a Category --' }}
                    </span>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div id="categoryList"
                     class="hidden absolute z-50 w-full bg-white border rounded shadow-lg mt-1 max-h-60 overflow-y-auto">
                    @php
                        $categories = [
                            'Education',
                            'Information Technology',
                            'Science & Technology',
                            'Health & Medicine',
                            'Engineering',
                            'Business & Management',
                            'Social Science',
                            'Agriculture',
                            'Environmental Science',
                            'Mathematics',
                            'Arts & Humanities',
                            'Law & Governance',
                        ];
                        $current = old('category', $research->category);
                    @endphp
                    @foreach($categories as $cat)
                        <div onclick="selectCategory('{{ strtolower($cat) }}', '{{ $cat }}')"
                             class="px-4 py-2 hover:bg-blue-50 cursor-pointer text-sm text-gray-700
                             {{ $current === strtolower($cat) ? 'bg-blue-50 font-semibold' : '' }}">
                            {{ $cat }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- ABSTRACT -->
        <textarea name="abstract"
                  class="w-full mb-2 p-2 border rounded"
                  rows="5">{{ old('abstract', $research->abstract) }}</textarea>

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

<script>
    // YEAR
    function toggleYearDropdown() {
        document.getElementById('yearList').classList.toggle('hidden');
        document.getElementById('categoryList').classList.add('hidden');
    }

    function selectYear(value) {
        document.getElementById('yearInput').value = value;
        document.getElementById('yearLabel').textContent = value;
        document.getElementById('yearList').classList.add('hidden');
    }

    // CATEGORY
    function toggleCategoryDropdown() {
        document.getElementById('categoryList').classList.toggle('hidden');
        document.getElementById('yearList').classList.add('hidden');
    }

    function selectCategory(value, label) {
        document.getElementById('categoryInput').value = value;
        document.getElementById('categoryLabel').textContent = label;
        document.getElementById('categoryList').classList.add('hidden');
    }

    // close both dropdowns if clicking outside
    document.addEventListener('click', function(e) {
        if (!document.getElementById('yearDropdown').contains(e.target)) {
            document.getElementById('yearList').classList.add('hidden');
        }
        if (!document.getElementById('categoryDropdown').contains(e.target)) {
            document.getElementById('categoryList').classList.add('hidden');
        }
    });
</script>

@endsection