<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Schedule;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'doctor';
    protected $fillable = [
        'doctor_description',
        'doctor_phone',
        'department_id',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function appointment(){
        return $this->hasMany(Appointment::class);
    }

    public function schedule(){
        return $this->hasMany(Schedule::class);
    }
}
