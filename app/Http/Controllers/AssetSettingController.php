<?php

namespace App\Http\Controllers;

use App\Models\AssetSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AssetSettingRequest;
use App\Http\Requests\AssetSettingUpdateRequest;

class AssetSettingController extends Controller
{
    public function index()
    {
        $assetSettings = [];
        if(Auth::user()->company) {
            $assetSettings = AssetSetting::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('assets.settings.index', compact('assetSettings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('assets.settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AssetSettingRequest $request)
    {
        $request->validated();

        $assetSetting = AssetSetting::create([
            'asset_type' => $request->asset_type,
            'description' => $request->description,
            'company_id' => Auth::user()->company->id,
        ]); 

        return redirect()->route('asset-settings.index')->with("success", $assetSetting->asset_type . " created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(AssetSetting $assetSetting)
    {
        return view('assets.settings.show', compact('assetSetting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AssetSetting $assetSetting)
    {
        return view('assets.settings.edit', compact('assetSetting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AssetSettingUpdateRequest $request, AssetSetting $assetSetting)
    {
        $request->validated();
        $assetSetting->update($request->all());
        return redirect()->route('asset-settings.index', $assetSetting)->with('success', $assetSetting->asset_type . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(AssetSetting $assetSetting)
    {
        $assetSetting->delete();
        return redirect()->route('asset-settings.index')->with('success', 'Asset setting deleted successfully');
    }
}
