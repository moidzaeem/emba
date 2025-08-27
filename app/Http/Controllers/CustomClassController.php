<?php

namespace App\Http\Controllers;

use App\Models\CustomClass;
use Illuminate\Http\Request;

class CustomClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = CustomClass::where('is_deleted', false)->get();
        return view('classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('classes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       CustomClass::create($request->validate([
            'name' => 'required',
        ]));

        return redirect()->route('classes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomClass $customClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomClass $class)
    {
      return view('classes.edit', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
       $customClass = CustomClass::findOrFail($id);
       $customClass->update($request->validate([
            'name' => 'required',
        ]));

        return redirect()->route('classes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $customClass = CustomClass::findOrFail($id);
         $customClass->update(['is_deleted'=>true]);
        return back();
    }
}
