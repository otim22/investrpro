<?php

namespace App\Http\Controllers;

use App\Models\Constitution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ConstitutionRequest;
use App\Http\Requests\ConstitutionUpdateRequest;

class ConstitutionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $constitutions = [];
        if(Auth::user()->company) {
            $constitutions = Constitution::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('constitution.index', compact('constitutions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('constitution.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ConstitutionRequest $request)
    {
        $request->validated();

        $constitution = Constitution::create([
            'title' => $request->title,
            'description' => $request->description,
            'company_id' => Auth::user()->company->id,
        ]); 

        if($request->hasFile('doc_attachement')) {
            $constitution->addMedia($request->doc_attachement)->toMediaCollection('doc_attachement');
        } 

        return redirect()->route('constitution.index')->with("success", $constitution->title . " created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Constitution $constitution)
    {
        return view('constitution.show', compact('Constitution'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Constitution $constitution)
    {
        return view('constitution.edit', compact('Constitution'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ConstitutionUpdateRequest $request, Constitution $constitution)
    {
        $request->validated();
        $constitution->update($request->except('doc_attachement'));
        if($request->hasFile('doc_attachement')) {
            $constitution->clearMediaCollection('doc_attachement');
            $constitution->addMedia($request->doc_attachement)->toMediaCollection('doc_attachement');
        }
        return redirect()->route('constitution.index', $constitution)->with('success', $constitution->title . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(Constitution $constitution)
    {
        $constitution->delete();
        return redirect()->route('constitution.index')->with('success', 'Constitution deleted successfully');
    }
}
