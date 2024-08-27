<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/**
 * @OA\Info(
 *     title="Doctor Appointment API",
 *     version="1.0.0",
 *     description="API Documentation for Doctor Appointment System",
 *     @OA\Contact(
 *         email="ujjwal999adhikari@gmail.com"
 *     )
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     description="Enter your bearer token in the format: `Bearer {token}`"
 * )
 *
 * @OA\Server(
 *     url="http://127.0.0.1:8000/api/",
 *     description="Doctor Appointment API Server"
 * )
 */
class SwaggerController extends Controller
{
    
}
