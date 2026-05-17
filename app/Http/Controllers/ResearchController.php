<?php

namespace App\Http\Controllers;

use App\Models\Research;
use Illuminate\Http\Request;

class ResearchController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | PUBLIC APPROVED RESEARCH LIST (WITH FILTERS)
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        $query = Research::where('status', 'approved');

        // YEAR FILTER
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        // CATEGORY FILTER
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $researches = $query->latest()->get();

        // YEARS DROPDOWN
        $years = Research::where('status', 'approved')
            ->select('year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        // CATEGORIES DROPDOWN
        $categories = Research::where('status', 'approved')
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('research.index', compact('researches', 'years', 'categories'));
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE FORM
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('research.create');
    }


    /*
    |--------------------------------------------------------------------------
    | STORE RESEARCH
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'author'   => 'required|string|max:255',
            'year'     => 'required|numeric',
            'category' => 'required|string|max:255',
            'abstract' => 'required|string',
            'file'     => 'nullable|mimes:pdf|max:2048',
        ]);

        // ✅ DUPLICATE CHECK — prevent same user submitting same title twice
        if (Research::where('title', $request->title)
                    ->where('user_id', auth()->id())
                    ->exists()) {
            return back()
                ->with('error', 'You already submitted a research with this title.')
                ->withInput();
        }

        $filePath = $request->hasFile('file')
            ? $request->file('file')->store('research_files', 'public')
            : null;

        Research::create([
            'title'    => $request->title,
            'author'   => $request->author,
            'year'     => $request->year,
            'category' => strtolower(trim($request->category)),
            'abstract' => $request->abstract,
            'status'   => 'pending',
            'file'     => $filePath,
            'user_id'  => auth()->id(),
        ]);

        return redirect()->route('research.my')
            ->with('success', 'Research submitted and pending review!');
    }


    /*
    |--------------------------------------------------------------------------
    | MY RESEARCH
    |--------------------------------------------------------------------------
    */
    public function myResearch()
    {
        $researches = Research::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('research.my', compact('researches'));
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $research = Research::findOrFail($id);

        if ($research->user_id !== auth()->id() || $research->status !== 'pending') {
            abort(403, 'You cannot edit this research.');
        }

        return view('research.edit', compact('research'));
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $research = Research::findOrFail($id);

        if ($research->user_id !== auth()->id() || $research->status !== 'pending') {
            abort(403, 'You cannot update this research.');
        }

        $request->validate([
            'title'    => 'required|string|max:255',
            'author'   => 'required|string|max:255',
            'year'     => 'required|numeric',
            'category' => 'required|string|max:255',
            'abstract' => 'required|string',
            'file'     => 'nullable|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $research->file = $request->file('file')->store('research_files', 'public');
        }

        $research->update([
            'title'    => $request->title,
            'author'   => $request->author,
            'year'     => $request->year,
            'category' => strtolower(trim($request->category)),
            'abstract' => $request->abstract,
            'file'     => $research->file,
        ]);

        return redirect()->route('research.my')
            ->with('success', 'Research updated successfully!');
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $research = Research::findOrFail($id);
        $user     = auth()->user();

        // ✅ Admin can delete any research
        // ✅ Researcher can only delete their own
        if ($user->role === 'admin' || $research->user_id === $user->id) {
            $research->delete();
            return back()->with('success', 'Research deleted successfully!');
        }

        abort(403, 'You are not allowed to delete this research.');
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW SINGLE RESEARCH
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $research = Research::findOrFail($id);

        $user = auth()->user();

        // Researchers can only view their own research if it's pending or rejected
        // They CAN view any approved research
        if ($user->isResearcher() && $research->user_id !== $user->id && $research->status !== 'approved') {
            abort(403, 'You are not allowed to view this research.');
        }

        return view('research.show', compact('research'));
    }
}