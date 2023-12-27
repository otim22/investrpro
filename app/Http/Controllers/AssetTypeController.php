<?php

namespace App\Http\Controllers;

use App\Models\AssetType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AssetTypeRequest;
use App\Http\Requests\AssetTypeUpdateRequest;

class AssetTypeController extends Controller
{
    public function index()
    {
        $assetTypes = [];
        if(Auth::user()->company) {
            $assetTypes = AssetType::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('asset_types.index', compact('assetTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('asset_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AssetTypeRequest $request)
    {
        $request->validated();

        $assetType = AssetType::create([
            'asset_type' => $request->asset_type,
            'description' => $request->description,
            'company_id' => Auth::user()->company->id,
        ]); 

        return redirect()->route('asset-types.index')->with("success", $assetType->asset_type . " created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(AssetType $assetType)
    {
        return view('asset_types.show', compact('assetType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AssetType $assetType)
    {
        return view('asset_types.edit', compact('assetType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AssetTypeUpdateRequest $request, AssetType $assetType)
    {
        $request->validated();
        $assetType->update($request->all());
        return redirect()->route('asset-types.index', $assetType)->with('success', $assetType->asset_type . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(AssetType $assetType)
    {
        $assetType->delete();
        return redirect()->route('asset-types.index')->with('success', 'Asset setting deleted successfully');
    }
}
