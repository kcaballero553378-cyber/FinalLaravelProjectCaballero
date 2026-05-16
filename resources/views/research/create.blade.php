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

            <!-- YEAR DROPDOWN -->
            <div>
                <label class="text-sm text-gray-600">Year</label>
                <input type="hidden" name="year" id="yearInput" value="{{ old('year') }}">
                <div class="relative mt-1" id="yearDropdown">
                    <button type="button"
                            onclick="toggleYearDropdown()"
                            class="w-full p-3 border rounded-lg bg-white text-left focus:ring-2 focus:ring-blue-400 outline-none flex justify-between items-center">
                        <span id="yearLabel">
                            {{ old('year') ? old('year') : '-- Select a Year --' }}
                        </span>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div id="yearList"
                         class="hidden absolute z-50 w-full bg-white border rounded-lg shadow-lg mt-1 max-h-60 overflow-y-auto">
                        @php $years = range(date('Y'), 2000); @endphp
                        @foreach($years as $year)
                            <div onclick="selectYear('{{ $year }}')"
                                 class="px-4 py-2 hover:bg-blue-50 cursor-pointer text-sm text-gray-700
                                 {{ old('year') == $year ? 'bg-blue-50 font-semibold' : '' }}">
                                {{ $year }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- CATEGORY CUSTOM DROPDOWN -->
            <div>
                <label class="text-sm text-gray-600">Category</label>
                <input type="hidden" name="category" id="categoryInput" value="{{ old('category') }}">
                <div class="relative mt-1" id="categoryDropdown">
                    <button type="button"
                            onclick="toggleCategoryDropdown()"
                            class="w-full p-3 border rounded-lg bg-white text-left focus:ring-2 focus:ring-blue-400 outline-none flex justify-between items-center">
                        <span id="categoryLabel">
                            {{ old('category') ? ucwords(old('category')) : '-- Select a Category --' }}
                        </span>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div id="categoryList"
                         class="hidden absolute z-50 w-full bg-white border rounded-lg shadow-lg mt-1 max-h-60 overflow-y-auto">
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
                        @endphp
                        @foreach($categories as $cat)
                            <div onclick="selectCategory('{{ strtolower($cat) }}', '{{ $cat }}')"
                                 class="px-4 py-2 hover:bg-blue-50 cursor-pointer text-sm text-gray-700
                                 {{ old('category') === strtolower($cat) ? 'bg-blue-50 font-semibold' : '' }}">
                                {{ $cat }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- ABSTRACT -->
            <div>
                <label class="text-sm text-gray-600">Abstract</label>
                <textarea name="abstract" rows="5"
                          class="w-full mt-1 p-3 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none"
                          placeholder="Enter research abstract">{{ old('abstract') }}</textarea>
            </div>

            <!-- FILE UPLOAD -->
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