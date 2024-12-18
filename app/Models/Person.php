<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'date_of_birth',
        'is_active',
        'comment',
        'is_employee'
    ];

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'is_active' => 'boolean',
    ];
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->infix} {$this->last_name}";
    }
}
