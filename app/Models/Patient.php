<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patiënt extends Model
{
    use HasFactory;

    protected $table = 'patients'; // Ensure the table name is correct

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
        return $this->person->name;
    }

    public static function bestaatAl($email)
    {
        return self::where('email', $email)->exists();
    }
}

