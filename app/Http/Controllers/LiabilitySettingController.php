<?php

namespace App\Http\Controllers;

use App\Models\LiabilitySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LiabilitySettingRequest;
use App\Http\Requests\LiabilitySettingUpdateRequest;

class LiabilitySettingController extends Controller
{
    public function index()
    {
        $liabilitySettings = [];
        if(Auth::user()->company) {
            $liabilitySettings = LiabilitySetting::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('liabilities.settings.index', compact('liabilitySettings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('liabilities.settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LiabilitySettingRequest $request)
    {
        $request->validated();

        $liabilitySetting = LiabilitySetting::create([
            'liability_type' => $request->liability_type,
            'description' => $request->description,
            'company_id' => Auth::user()->company->id,
        ]); 

        return redirect()->route('liability-settings.index')->with("success", $liabilitySetting->liability_type . " created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(LiabilitySetting $liabilitySetting)
    {
        return view('liabilities.settings.show', compact('liabilitySetting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LiabilitySetting $liabilitySetting)
    {
        return view('liabilities.settings.edit', compact('liabilitySetting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LiabilitySettingUpdateRequest $request, LiabilitySetting $liabilitySetting)
    {
        $request->validated();
        $liabilitySetting->update($request->all());
        return redirect()->route('liability-settings.index', $liabilitySetting)->with('success', $liabilitySetting->liability_type . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(LiabilitySetting $liabilitySetting)
    {
        $liabilitySetting->delete();
        return redirect()->route('liability-settings.index')->with('success', 'Liability setting deleted successfully');
    }
}
