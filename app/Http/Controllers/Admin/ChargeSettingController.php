<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use App\Models\ChargeSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ChargeSettingRequest;
use App\Http\Requests\ChargeSettingUpdateRequest;

class ChargeSettingController extends Controller
{
    public function index()
    {
        $chargeSettings = [];
        if(Auth::user()) {
            $chargeSettings = ChargeSetting::orderBy('id', 'desc')->get();
        }
        return view('admin.charge_types.index', compact('chargeSettings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::orderBy('id', 'desc')->get();
        return view('admin.charge_types.create', compact('companies'));
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
            'company_id' => $request->company_id,
        ]); 
        return redirect()->route('admin.charge-settings.index')->with("success", $chargeSetting->title . " created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(ChargeSetting $chargeSetting)
    {
        $companies = Company::orderBy('id', 'desc')->get();
        return view('admin.charge_types.show', compact(['chargeSetting', 'companies']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ChargeSetting $chargeSetting)
    {
        $companies = Company::orderBy('id', 'desc')->get();
        return view('admin.charge_types.edit', compact(['chargeSetting', 'companies']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChargeSettingUpdateRequest $request, ChargeSetting $chargeSetting)
    {
        $request->validated();
        $chargeSetting->update($request->all());
        return redirect()->route('admin.charge-settings.index', $chargeSetting)->with('success', $chargeSetting->title . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(ChargeSetting $chargeSetting)
    {
        $charge->delete();
        return redirect()->route('admin.charge-settings.index')->with('success', 'Charge deleted successfully');
    }
}
