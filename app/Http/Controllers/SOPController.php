<?php

namespace App\Http\Controllers;

use App\Models\Sop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SopRequest;
use App\Http\Requests\SopUpdateRequest;

class SopController extends Controller
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
        $sops = [];
        if(Auth::user()->company) {
            $sops = Sop::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('sop.index', compact('sops'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sop.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SopRequest $request)
    {
        $request->validated();

        $sop = Sop::create([
            'title' => $request->title,
            'description' => $request->description,
            'company_id' => Auth::user()->company->id,
        ]); 

        if($request->hasFile('doc_attachement')) {
            $sop->addMedia($request->doc_attachement)->toMediaCollection('doc_attachement');
        } 

        return redirect()->route('sop.index')->with("success", $sop->title . " created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Sop $sop)
    {
        $sopUrl = $sop->getFirstMediaUrl('doc_attachement');
        return view('sop.show', compact(['sop', 'sopUrl']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sop $sop)
    {
        return view('sop.edit', compact('sop'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SopUpdateRequest $request, Sop $sop)
    {
        $request->validated();
        $sop->update($request->except('doc_attachement'));
        if($request->hasFile('doc_attachement')) {
            $sop->clearMediaCollection('doc_attachement');
            $sop->addMedia($request->doc_attachement)->toMediaCollection('doc_attachement');
        }
        return redirect()->route('sop.index', $sop)->with('success', $sop->title . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(Sop $sop)
    {
        $sop->delete();
        return redirect()->route('sop.index')->with('success', 'SOP deleted successfully');
    }

    public function download($id)
    {
        $sop = Sop::findOrFail($id);
        $path = $sop->getFirstMedia('doc_attachement')->getPath();
        $file_name = $sop->getFirstMedia('doc_attachement')->file_name;
        return response()->download($path, $file_name);
    }
}
