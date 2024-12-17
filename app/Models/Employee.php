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
        'user_id',
        'number',
        'name',
        'email',
        'employee_type',
        'specialization',
        'availability',
        'is_active',
        'comment',
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
        return $this->person->name;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($employee) {
            do {
                $randomNumber = mt_rand(100000, 999999); // Genereer een nummer met 6 cijfers
            } while (self::where('number', $randomNumber)->exists()); // Controleer uniekheid

            $employee->number = $randomNumber; // Stel het nummer in
        });
    }
}
