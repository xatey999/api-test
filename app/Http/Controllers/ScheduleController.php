<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @OA\Schema(
 *     schema="Schedules",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="day", type="string", example="Monday"),
 *     @OA\Property(property="start_time", type="string", format="time", example="09:00:00"),
 *     @OA\Property(property="end_time", type="string", format="time", example="17:00:00"),
 *     @OA\Property(property="doctor_id", type="integer", example=5),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-08-27T12:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-08-27T12:00:00Z")
 * )
 */

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //schedules list as per the logged in doctor
        $schedules = Schedule::query()->where('doctor_id', '=', Auth::user()->doctor->id)->get();
        return response()->json($schedules, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
 * @OA\Post(
 *     path="/schedules",
 *     summary="Store a newly created schedule for a doctor",
 *     description="Store a doctor's schedule and return the stored data along with a success message",
 *     tags={"Schedules"},
 *     security={{"bearerAuth":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"day", "start_time", "end_time"},
 *             @OA\Property(property="day", type="string", enum={"Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"}, example="Monday"),
 *             @OA\Property(property="start_time", type="string", format="time", example="06:00"),
 *             @OA\Property(property="end_time", type="string", format="time", example="07:30")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Schedule created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="schedule", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="doctor_id", type="integer", example=5),
 *                 @OA\Property(property="day", type="string", example="Monday"),
 *                 @OA\Property(property="start_time", type="string", format="time", example="09:00:00"),
 *                 @OA\Property(property="end_time", type="string", format="time", example="17:00:00"),
 *             ),
 *             @OA\Property(property="status", type="object",
 *                 @OA\Property(property="message", type="string", example="Schedule created successfully"),
 *                 @OA\Property(property="type", type="string", example="success")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation Error",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="The given data was invalid."),
 *             @OA\Property(property="errors", type="object",
 *                 @OA\Property(property="day", type="array", @OA\Items(type="string", example="The day field is required.")),
 *                 @OA\Property(property="start_time", type="array", @OA\Items(type="string", example="The start_time field is required.")),
 *                 @OA\Property(property="end_time", type="array", @OA\Items(type="string", example="The end_time field is required."))
 *             )
 *         )
 *     )
 * )
 */
   

    public function store(Request $request)
    {

        $schedule = new Schedule();
        $schedule->doctor_id = auth()->user()->doctor->id;
        $schedule->fill($request->all());
        $schedule->save();
        return response()->json('Schedule created successfully', 200);
    }

    /**
     * Display the specified resource.
     */

     /**
     * @OA\Get(
     *     path="/schedules",
     *     summary="Get all the schedule list of the current doctor",
     *     tags={"Schedules"},
     
     *     @OA\Response(
     *         response=200,
     *         description="A specific schedule",
     *         @OA\JsonContent(ref="#/components/schemas/Schedules")
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
     */

    public function show()
    {
        $schedule = Schedule::query()->where('doctor_id', '=', Auth::user()->doctor->id)->get();
        return response()->json($schedule, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $schedule = Schedule::find($id);
        return view("doctor.updateschedule", compact("schedule"));
    }

    /**
     * Update the specified resource in storage.
     */

/**
     * @OA\Put(
     *     path="/schedules/{id}",
     *     summary="Update a specific schedule",
     *     description="Update details of a specific schedule by ID.",
     *     tags={"Schedules"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the schedule to update",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"week_day", "start_time", "end_time"},
     *             @OA\Property(property="day", type="string", enum={"Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"}, example="Monday"),
     *             @OA\Property(property="start_time", type="string", format="time", example="09:00:00"),
     *             @OA\Property(property="end_time", type="string", format="time", example="17:00:00")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Schedule successfully updated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Schedule Updated"),
     *             @OA\Property(property="schedule", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="doctor_id", type="integer", example=1),
     *                 @OA\Property(property="day", type="string", enum={"Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"}, example="Monday"),
     *                 @OA\Property(property="start_time", type="string", format="time", example="09:00:00"),
     *                 @OA\Property(property="end_time", type="string", format="time", example="17:00:00"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2024-08-29T00:00:00Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-08-29T00:00:00Z")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthorized to update with your role"),
     *             @OA\Property(property="type", type="string", example="error")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Schedule not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Schedule not found"),
     *             @OA\Property(property="type", type="string", example="error")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation Error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object",
     *                 @OA\Property(property="day", type="array", @OA\Items(type="string", example="The selected week_day is invalid.")),
     *                 @OA\Property(property="start_time", type="array", @OA\Items(type="string", example="The start_time field is required and must be a valid time.")),
     *                 @OA\Property(property="end_time", type="array", @OA\Items(type="string", example="The end_time field is required and must be a valid time."))
     *             )
     *         )
     *     )
     * )
     */
     
    public function update(Request $request, $id)
    {
        $schedule = Schedule::find($id);
        $schedule->doctor_id = auth()->user()->doctor->id;
        $schedule->day = $request->input('day');
        $schedule->start_time = $request->input('start_time');
        $schedule->end_time = $request->input('end_time');
        if ($request->user()->cannot('update', $schedule)) {
            return response()->json([
                'error' => 'Unauthorized action',
                'data' => null
            ], 403);
        }
        $schedule->save();
        return response()->json([
            'success' => 'Updated Successfully!!',
            'data' => ['id' => $schedule->id, 'doctor_id' => $schedule->doctor_id, 'day' => $schedule->day, 'start_time' => $schedule->start_time, 'end_time' => $schedule->end_time]
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */

      /**
     * @OA\Delete(
     *     path="/schedules/{id}",
     *     summary="Delete a specific schedule",
     *     tags={"Schedules"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the schedule",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Schedule deleted successfully"
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
     */

    public function destroy(Request $request, string $id)
    {
        $schedule = Schedule::find($id);
        if ($request->user()->cannot('delete', $schedule)) {
            return response()->json([
                'error' => 'Unauthorized action',
                'data' => null
            ], 403);
        }
        $schedule->delete();
        return response()->json('Schedule deleted successfully', 200);
    }
}
