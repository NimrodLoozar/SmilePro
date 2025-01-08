<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patiënt extends Model
{
    use HasFactory;

    protected $fillable = [
        'naam',
        'geboortedatum',
        'email',
        'telefoonnummer',
        // Voeg hier extra velden toe indien nodig
    ];

    public static function bestaatAl($email)
    {
        return self::where('email', $email)->exists();
    }
}
