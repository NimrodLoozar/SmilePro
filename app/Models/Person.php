<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'people'; // Ensure the table name is correct
    

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getFullNameAttribute()
    {
        return $this->name;
    }
}
