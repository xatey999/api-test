<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorFormValidationRequest;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*

*/
class DoctorController extends Controller
{
    
     
    public function index()
    {
        // Implement logic to display a list of doctors
    }

    /**
 * @OA\Post(
 *     path="/doctor/store",
 *     summary="Store a newly created doctor's information",
 *     description="Store a doctor's information and return the stored data along with a success message",
 *     tags={"Doctors"},
 *     security={{"bearerAuth":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"doctor_description", "doctor_phone", "department_id", "user_id"},
 *             @OA\Property(property="doctor_description", type="string", example="Experienced Cardiologist with 10 years of practice."),
 *             @OA\Property(property="doctor_phone", type="string", example="+1234567890"),
 *             @OA\Property(property="department_id", type="integer", example=1),
 *             @OA\Property(property="user_id", type="integer", example=5)
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Doctor information stored successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="doctor", type="object",
 *                 @OA\Property(property="id", type="integer", example=10),
 *                 @OA\Property(property="doctor_description", type="string", example="Experienced Cardiologist with 10 years of practice."),
 *                 @OA\Property(property="doctor_phone", type="string", example="+1234567890"),
 *                 @OA\Property(property="department_id", type="integer", example=1),
 *                 @OA\Property(property="user_id", type="integer", example=5),
 *                 @OA\Property(property="created_at", type="string", example="2024-08-27T12:00:00Z"),
 *                 @OA\Property(property="updated_at", type="string", example="2024-08-27T12:00:00Z")
 *             ),
 *             @OA\Property(property="status", type="object",
 *                 @OA\Property(property="message", type="string", example="Doctor information stored successfully"),
 *                 @OA\Property(property="type", type="string", example="success")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Doctor data already exists",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="You already have inserted your data"),
 *             @OA\Property(property="type", type="string", example="error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation Error",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="The given data was invalid."),
 *             @OA\Property(property="errors", type="object",
 *                 @OA\Property(property="doctor_description", type="array", @OA\Items(type="string", example="The doctor_description field is required.")),
 *                 @OA\Property(property="doctor_phone", type="array", @OA\Items(type="string", example="The doctor_phone field is required.")),
 *                 @OA\Property(property="department_id", type="array", @OA\Items(type="string", example="The department_id field is required.")),
 *                 @OA\Property(property="user_id", type="array", @OA\Items(type="string", example="The user_id field is required."))
 *             )
 *         )
 *     )
 * )
 */

    
    public function store(DoctorFormValidationRequest $request)
    {
        // Check if the authenticated user is already a doctor recorded
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

    public function show(string $id)
    {
        // Implement logic to display a specific doctor's information
    }

    public function update(Request $request, string $id)
    {
        // Implement logic to update a specific doctor's information
    }

    public function destroy(string $id)
    {
        // Implement logic to delete a specific doctor
    }
}
