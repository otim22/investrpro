<?php

namespace App\Http\Controllers;

use App\Models\ChargeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ChargeSettingRequest;
use App\Http\Requests\ChargeSettingUpdateRequest;

class ChargeSettingController extends Controller
{
    public function index()
    {
        $chargeSettings = [];
        if(Auth::user()->company) {
            $chargeSettings = ChargeSetting::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('charges.settings.index', compact('chargeSettings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('charges.settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChargeSettingRequest $request)
    {
        $request->validated();

        $chargeSetting = ChargeSetting::create([
            'title' => $request->title,
            'description' => $request->description,
            'amount' => $request->amount,
            'company_id' => Auth::user()->company->id,
        ]); 

        return redirect()->route('charge-settings.index')->with("success", $chargeSetting->title . " created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(ChargeSetting $chargeSetting)
    {
        return view('charges.settings.show', compact('chargeSetting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ChargeSetting $chargeSetting)
    {
        return view('charges.settings.edit', compact('chargeSetting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChargeSettingUpdateRequest $request, ChargeSetting $chargeSetting)
    {
        $request->validated();
        $chargeSetting->update($request->all());
        return redirect()->route('charge-settings.index', $chargeSetting)->with('success', $chargeSetting->title . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(ChargeSetting $chargeSetting)
    {
        $charge->delete();
        return redirect()->route('charge-settings.index')->with('success', 'Charge deleted successfully');
    }
}
