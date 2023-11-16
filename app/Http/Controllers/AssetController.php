<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AssetRequest;
use App\Http\Requests\AssetUpdateRequest;

class AssetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $assets = [];

        if(Auth::user()->company) {
            $assets = Asset::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
            $totalNetworth = Asset::where('company_id', Auth::user()->company->id)->get()->reduce(function($carry, $item){
                return $carry += $item->amount;
            }, 0);
            $totalByTypes = Asset::where('company_id', Auth::user()->company->id)->get()->groupBy('asset_type')
                ->map(function ($option) {
                    return $option
                            ->reduce(function($carry, $item) {
                                return $carry += $item->amount;
                            });
                });
        }

        return view('assets.asset.index', compact(['assets', 'totalNetworth', 'totalByTypes']));
    }

    public function create()
    {
        $assetTypes = [];
        if(Auth::user()->company) {
            $assetTypes = AssetSetting::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('assets.asset.create', compact('assetTypes'));
    }

    public function store(AssetRequest $request)
    {
        $request->validated();

        $asset = Asset::create([
            'asset_name' => $request->asset_name,
            'asset_type' => $request->asset_type,
            'amount' => $request->amount,
            'financial_year' => $request->financial_year,
            'date_acquired' => $request->date_acquired,
            'company_id' => Auth::user()->company->id,
        ]);
 
        return redirect()->route('assets.index')->with("success", $asset->asset_type . " saved successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Asset $asset)
    {
        $assetTypes = [];
        if(Auth::user()->company) {
            $assetTypes = AssetSetting::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('assets.asset.show', compact(['asset', 'assetTypes']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asset $asset)
    {
        $assetTypes = [];
        if(Auth::user()->company) {
            $assetTypes = AssetSetting::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('assets.asset.edit', compact(['asset', 'assetTypes']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AssetUpdateRequest $request, Asset $asset)
    {
        $request->validated();
        $asset->update($request->all());
        return redirect()->route('assets.index', $asset)->with('success', $asset->asset_type . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(Asset $asset)
    {
        $asset->delete();
        return redirect()->route('assets.index')->with('success', 'Asset deleted successfully');
    }
}
