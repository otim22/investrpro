<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use App\Models\AssetType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AssetTypeRequest;
use App\Http\Requests\AssetTypeUpdateRequest;

class AssetTypeController extends Controller
{
    public function index()
    {
        $assetTypes = [];
        if(Auth::user()) {
            $assetTypes = AssetType::orderBy('id', 'desc')->get();
        }
        return view('admin.asset_types.index', compact('assetTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::orderBy('id', 'desc')->get();
        return view('admin.asset_types.create', compact('companies'));
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
            'company_id' => $request->company_id,
        ]); 
        return redirect()->route('admin.asset-types.index')->with("success", $assetType->asset_type . " created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(AssetType $assetType)
    {
        $companies = Company::orderBy('id', 'desc')->get();
        return view('admin.asset_types.show', compact(['assetType', 'companies']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AssetType $assetType)
    {
        $companies = Company::orderBy('id', 'desc')->get();
        return view('admin.asset_types.edit', compact(['assetType', 'companies']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AssetTypeUpdateRequest $request, AssetType $assetType)
    {
        $request->validated();
        $assetType->update($request->all());
        return redirect()->route('admin.asset-types.index', $assetType)->with('success', $assetType->asset_type . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(AssetType $assetType)
    {
        $assetType->delete();
        return redirect()->route('admin.asset-types.index')->with('success', 'Asset setting deleted successfully');
    }
}
