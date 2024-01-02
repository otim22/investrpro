<?php

namespace App\Http\Controllers;

use App\Models\Procedure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProcedureRequest;
use App\Http\Requests\ProcedureUpdateRequest;

class ProcedureController extends Controller
{
    public function index()
    {
        $procedure = null;
        $procedureUrl = null;
        if(Auth::user()->company) {
            $procedure = Procedure::where('company_id', Auth::user()->company->id)->first();
            if (isset($procedure)) {
                $procedureUrl = $procedure->getFirstMediaUrl('doc_attachement');
            }
        }
        return view('procedure.index', compact('procedure', 'procedureUrl'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('procedure.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProcedureRequest $request)
    {
        $request->validated();
        $procedure = Procedure::create([
            'title' => $request->title,
            'description' => $request->description,
            'company_id' => Auth::user()->company->id,
        ]); 

        if($request->hasFile('doc_attachement')) {
            $procedure->addMedia($request->doc_attachement)->toMediaCollection('doc_attachement');
        } 

        return redirect()->route('procedures.index')->with("success", $procedure->title . " created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Procedure $procedure)
    {
        $procedureUrl = $procedure->getFirstMediaUrl('doc_attachement');
        return view('procedure.show', compact(['procedure', 'procedureUrl']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Procedure $procedure)
    {
        return view('procedure.edit', compact('procedure'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProcedureUpdateRequest $request, Procedure $procedure)
    {
        $request->validated();
        $procedure->update($request->except('doc_attachement'));
        if($request->hasFile('doc_attachement')) {
            $procedure->clearMediaCollection('doc_attachement');
            $procedure->addMedia($request->doc_attachement)->toMediaCollection('doc_attachement');
        }
        return redirect()->route('procedures.index', $procedure)->with('success', $procedure->title . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(Procedure $procedure)
    {
        $procedure->delete();
        return redirect()->route('procedures.index')->with('success', 'Procedure deleted successfully');
    }

    public function download($id)
    {
        $procedure = Procedure::findOrFail($id);
        $path = $procedure->getFirstMedia('doc_attachement')->getPath();
        $file_name = $procedure->getFirstMedia('doc_attachement')->file_name;
        return response()->download($path, $file_name);
    }
}

