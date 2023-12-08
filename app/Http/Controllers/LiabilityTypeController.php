<?php

namespace App\Http\Controllers;

use App\Models\LiabilityType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LiabilityTypeRequest;
use App\Http\Requests\LiabilityTypeUpdateRequest;

class LiabilityTypeController extends Controller
{
    public function index()
    {
        $liabilityTypes = [];
        if(Auth::user()->company) {
            $liabilityTypes = LiabilityType::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('liabilities.types.index', compact('liabilityTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('liabilities.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LiabilityTypeRequest $request)
    {
        $request->validated();

        $liabilityType = LiabilityType::create([
            'liability_type' => $request->liability_type,
            'description' => $request->description,
            'company_id' => Auth::user()->company->id,
        ]); 

        return redirect()->route('liability-types.index')->with("success", $liabilityType->liability_type . " created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(LiabilityType $liabilityType)
    {
        return view('liabilities.types.show', compact('liabilityType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LiabilityType $liabilityType)
    {
        return view('liabilities.types.edit', compact('liabilityType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LiabilityTypeUpdateRequest $request, LiabilityType $liabilityType)
    {
        $request->validated();
        $liabilityType->update($request->all());
        return redirect()->route('liability-types.index', $liabilityType)->with('success', $liabilityType->liability_type . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(LiabilityType $liabilityType)
    {
        $liabilityType->delete();
        return redirect()->route('liability-types.index')->with('success', 'Liability type deleted successfully');
    }
}
