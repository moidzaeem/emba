<?php

namespace App\Http\Controllers;

use App\Imports\ParticipantsImport;
use App\Models\Participant;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $participants = Participant::all();
        return view('participants.index', compact('participants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('participants.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Participant::create($request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'focus' => 'required|in:Healthcare,Finance',
            'gender' => 'required|in:Male,Female',
            'class' => 'required|integer|min:1|max:2'
        ]));

        return redirect()->route('participants.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Participant $participant)
    {
        return view('participants.edit', compact('participant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Participant $participant)
    {
        $participant->update($request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'focus' => 'required|in:Healthcare,Finance',
            'gender' => 'required|in:Male,Female',
            'class' => 'required|integer|min:1|max:2'
        ]));

        return redirect()->route('participants.index');
    }

    public function destroy(Participant $participant)
    {
        $participant->delete();
        return back();
    }

    public function import(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx,xls,csv']);
        Excel::import(new ParticipantsImport, $request->file('file'));
        return redirect()->route('participants.index')->with('success', 'Participants imported!');
    }
}
