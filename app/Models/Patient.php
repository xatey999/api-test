<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patient';
    protected $fillable = [
        'date_of_birth',
        'gender',
        'address',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function appointment(){
        return $this->hasMany(Appointment::class);
    }
}
