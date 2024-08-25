<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'department';
    protected $fillable = [
        'name',
        'description',
    ];

    public function doctor()
    {
        return $this->hasMany(Doctor::class);
    }
}
