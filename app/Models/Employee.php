<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    // yo! I'm a comment
    use HasFactory;

    protected $table = 'employee';

    protected $fillable = [
        'person_id',
        'number',
        'employee_type',
        'specialization',
        'availability',
        'is_active',
        'comment'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function getFullNameAttribute()
    {
        return isset($this->person) ? $this->person->first_name . ' ' . $this->person->last_name : 'N/A';
    }
}
