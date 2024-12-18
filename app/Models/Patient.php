<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;


    // protected $table = 'patient';

    protected $fillable = [
        'person_id',
        'number',
        'medical_file',
        'is_active',
        'comment'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getFullNameAttribute()
    {
        return $this->person->first_name . ' ' . $this->person->last_name;
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
