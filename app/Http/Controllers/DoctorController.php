<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorFormValidationRequest;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DoctorFormValidationRequest $request)
    {
        // Check if the authenticated user already has a doctor record
    $existingDoctor = Doctor::where('user_id', Auth::user()->id)->first();

    if ($existingDoctor) {
        return response()->json(['message' => 'You already have insert your data'], 400);
    }
        $doctor_Data = new Doctor();
        $doctor_Data->fill($request->all());
        $doctor_Data->user_id = Auth::user()->id;
        $doctor_Data->save();
        return response()->json($doctor_Data, 200);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
