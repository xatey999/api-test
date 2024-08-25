<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointment';
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'appointment_date',
        'appointment_time',
        'appointment_reason',

    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }

    public function doctors()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }
}
