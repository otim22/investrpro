<?php

namespace App\Http\Controllers;

use App\Models\Liability;
use App\Models\LiabilitySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LiabilityRequest;
use App\Http\Requests\LiabilityUpdateRequest;

class LiabilityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $liabilities = [];
        if(Auth::user()->company) {
            $liabilities = Liability::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
            $totalValue = Liability::where('company_id', Auth::user()->company->id)->get()->reduce(function($carry, $item){
                return $carry += $item->amount;
            }, 0);
            $totalByTypes = Liability::where('company_id', Auth::user()->company->id)->get()->groupBy('liability_type')
                ->map(function ($option) {
                    return $option
                            ->reduce(function($carry, $item) {
                                return $carry += $item->amount;
                            });
                });
        }
        return view('liabilities.liability.index', compact(['liabilities', 'totalValue', 'totalByTypes']));
    }

    public function create()
    {
        $liabilityTypes = [];
        if(Auth::user()->company) {
            $liabilityTypes = LiabilitySetting::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('liabilities.liability.create', compact('liabilityTypes'));
    }

    public function store(LiabilityRequest $request)
    {
        $request->validated();

        $asset = Liability::create([
            'liability_name' => $request->liability_name,
            'liability_type' => $request->liability_type,
            'amount' => $request->amount,
            'financial_year' => $request->financial_year,
            'date_acquired' => $request->date_acquired,
            'company_id' => Auth::user()->company->id,
        ]);

 
        return redirect()->route('liabilities.index')->with("success", "Liability saved successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Liability $liability)
    {
        $liabilityTypes = [];
        if(Auth::user()->company) {
            $liabilityTypes = LiabilitySetting::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('liabilities.liability.show', compact(['liability', 'liabilityTypes']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Liability $liability)
    {
        $liabilityTypes = [];
        if(Auth::user()->company) {
            $liabilityTypes = LiabilitySetting::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('liabilities.liability.edit', compact(['liability', 'liabilityTypes']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LiabilityUpdateRequest $request, Liability $liability)
    {
        $request->validated();
        $liability->update($request->all());
        return redirect()->route('liabilities.index', $liability)->with('success', 'Liability updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(Liability $liability)
    {
        $liability->delete();
        return redirect()->route('liabilities.index')->with('success', 'Liability deleted successfully');
    }
}
