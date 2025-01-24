<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = 'appointments'; // Ensure the table name is correct

    use HasFactory;

    // Appointment.php
    protected $fillable = ['patient_id', 'employee_id', 'name', 'date', 'time', 'status', 'is_active', 'comment'];

    protected $casts = [
        'is_active' => 'boolean',
    ];


    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
