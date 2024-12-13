<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patient';

    protected $fillable = [
        'person_id',
        'name',
        'number',
        'medical_file',
        'is_active',
        'comment',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id', 'id');
    }

    public function getFullNameAttribute()
    {
        return isset($this->person) ? $this->person->name : 'N/A';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($patient) {
            do {
                $randomNumber = mt_rand(100000, 999999); // Generate a 6-digit number
            } while (self::where('number', $randomNumber)->exists()); // Check for uniqueness

            $patient->number = $randomNumber; // Set the number
        });
    }
}