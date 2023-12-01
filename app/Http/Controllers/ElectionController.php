<?php

namespace App\Http\Controllers;

use App\Models\Election;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ElectionRequest;
use App\Http\Requests\ElectionUpdateRequest;

class ElectionController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $elections = [];
        if(Auth::user()->company) {
            $elections = Election::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('elections.index', compact('elections'));
    }
 /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('elections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ElectionRequest $request)
    {
        $request->validated();

        $election = Election::create([
            'title' => $request->title,
            'description' => $request->description,
            'company_id' => Auth::user()->company->id,
        ]); 

        if($request->hasFile('doc_attachement')) {
            $election->addMedia($request->doc_attachement)->toMediaCollection('doc_attachement');
        } 

        return redirect()->route('elections.index')->with("success", $election->title . " created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Election $election)
    {
        $electionUrl = $election->getFirstMediaUrl('doc_attachement');
        return view('elections.show', compact(['election', 'electionUrl']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Election $election)
    {
        return view('elections.edit', compact('election'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ElectionUpdateRequest $request, Election $election)
    {
        $request->validated();
        $election->update($request->except('doc_attachement'));
        if($request->hasFile('doc_attachement')) {
            $election->clearMediaCollection('doc_attachement');
            $election->addMedia($request->doc_attachement)->toMediaCollection('doc_attachement');
        }
        return redirect()->route('elections.index', $election)->with('success', $election->title . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(Election $election)
    {
        $election->delete();
        return redirect()->route('elections.index')->with('success', 'Election deleted successfully');
    }

    public function download($id)
    {
        $election = Election::findOrFail($id);
        $path = $election->getFirstMedia('doc_attachement')->getPath();
        $file_name = $election->getFirstMedia('doc_attachement')->file_name;
        return response()->download($path, $file_name);
    }
}
