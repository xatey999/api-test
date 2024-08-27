<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientFormValidationRequest;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Doctor::with('department')->get();
        return response()->json($query, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PatientFormValidationRequest $request)
    {
        // Check if the authenticated user is already a patient recorded
    $existingPatient = Patient::where('user_id', Auth::user()->id)->first();

    if ($existingPatient) {
        return response()->json(['message' => 'You already have insert your information.'], 400);
    }
        $patient = new Patient();
        $patient->fill($request->all());
        $patient->user_id = Auth::user()->id;
        $patient->save();
        return response()->json($patient, 200);
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
