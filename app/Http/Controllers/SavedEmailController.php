<?php

namespace App\Http\Controllers;

use App\Models\SavedEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SavedEmailRequest;
use App\Http\Requests\SavedEmailUpdateRequest;

class SavedEmailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $savedEmails = [];
        if(Auth::user()->company) {
            $savedEmails = SavedEmail::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('saved_emails.index', compact('savedEmails'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('saved_emails.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SavedEmailRequest $request)
    {
        $request->validated();

        $savedEmail = SavedEmail::create([
            'title' => $request->title,
            'description' => $request->description,
            'company_id' => Auth::user()->company->id,
        ]); 

        if($request->hasFile('doc_attachement')) {
            $savedEmail->addMedia($request->doc_attachement)->toMediaCollection('doc_attachement');
        } 

        return redirect()->route('saved-emails.index')->with("success", $savedEmail->title . " created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(SavedEmail $savedEmail)
    {
        $savedEmailUrl = $savedEmail->getFirstMediaUrl('doc_attachement');
        return view('saved_emails.show', compact(['savedEmail', 'savedEmailUrl']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SavedEmail $savedEmail)
    {
        return view('saved_emails.edit', compact('savedEmail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SavedEmailUpdateRequest $request, SavedEmail $savedEmail)
    {
        $request->validated();
        $savedEmail->update($request->except('doc_attachement'));
        if($request->hasFile('doc_attachement')) {
            $savedEmail->clearMediaCollection('doc_attachement');
            $savedEmail->addMedia($request->doc_attachement)->toMediaCollection('doc_attachement');
        }
        return redirect()->route('saved-emails.index', $savedEmail)->with('success', $savedEmail->title . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(SavedEmail $savedEmail)
    {
        $savedEmail->delete();
        return redirect()->route('saved-emails.index')->with('success', 'Saved email deleted successfully');
    }

    public function download($id)
    {
        $savedEmail = SavedEmail::findOrFail($id);
        $path = $savedEmail->getFirstMedia('doc_attachement')->getPath();
        $file_name = $savedEmail->getFirstMedia('doc_attachement')->file_name;
        return response()->download($path, $file_name);
    }
}
