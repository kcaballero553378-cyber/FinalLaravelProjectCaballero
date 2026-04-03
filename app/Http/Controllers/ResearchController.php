<?php

namespace App\Http\Controllers;

use App\Models\Research;
use Illuminate\Http\Request;

class ResearchController extends Controller
{
    public function index()
    {
        $researches = Research::all();
        return view('research.index', compact('researches'));
    }

    public function create()
    {
        return view('research.create');
    }

    public function store(Request $request)
    {
        Research::create($request->all());
        return redirect()->route('research.index');
    }

    public function edit($id)
    {
        $research = Research::findOrFail($id);
        return view('research.edit', compact('research'));
    }

    public function update(Request $request, $id)
    {
        $research = Research::findOrFail($id);
        $research->update($request->all());

        return redirect()->route('research.index');
    }

    public function destroy($id)
    {
        Research::destroy($id);
        return redirect()->route('research.index');
    }
}