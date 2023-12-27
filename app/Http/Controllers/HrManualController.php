<?php

namespace App\Http\Controllers;

use App\Models\HrManual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\HrManualRequest;
use App\Http\Requests\HrManualUpdateRequest;

class HrManualController extends Controller
{
    public function index()
    {
        $hrManuals = [];
        if(Auth::user()->company) {
            $hrManuals = HrManual::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('hr_manuals.index', compact('hrManuals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hr_manuals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HrManualRequest $request)
    {
        $request->validated();

        $hrManual = HrManual::create([
            'title' => $request->title,
            'description' => $request->description,
            'company_id' => Auth::user()->company->id,
        ]); 

        if($request->hasFile('doc_attachement')) {
            $hrManual->addMedia($request->doc_attachement)->toMediaCollection('doc_attachement');
        } 

        return redirect()->route('hr-manuals.index')->with("success", $hrManual->title . " created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(HrManual $hrManual)
    {
        $hrManualUrl = $hrManual->getFirstMediaUrl('doc_attachement');
        return view('hr_manuals.show', compact(['hrManual', 'hrManualUrl']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HrManual $hrManual)
    {
        return view('hr_manuals.edit', compact('hrManual'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HrManualUpdateRequest $request, HrManual $hrManual)
    {
        $request->validated();
        $hrManual->update($request->except('doc_attachement'));
        if($request->hasFile('doc_attachement')) {
            $hrManual->clearMediaCollection('doc_attachement');
            $hrManual->addMedia($request->doc_attachement)->toMediaCollection('doc_attachement');
        }
        return redirect()->route('hr-manuals.index', $hrManual)->with('success', $hrManual->title . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(HrManual $hrManual)
    {
        $hrManual->delete();
        return redirect()->route('hr-manuals.index')->with('success', 'Manual deleted successfully');
    }

    public function download($id)
    {
        $hrManual = HrManual::findOrFail($id);
        $path = $hrManual->getFirstMedia('doc_attachement')->getPath();
        $file_name = $hrManual->getFirstMedia('doc_attachement')->file_name;
        return response()->download($path, $file_name);
    }
}
