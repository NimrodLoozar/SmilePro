<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'voornaam',
        'tussenvoegsel',
        'achternaam',
        'geboortedatum',
        'isactief',
        'opmerking',
        'datumaangemaakt',
        'datumgewijzigd',
    ];

    /**
     * Define relationships with Gebruiker, Patient, and Medewerker models.
     */
    public function gebruiker()
    {
        return $this->hasOne(User::class, 'persoon_id');
    }

    public function patient()
    {
        return $this->hasOne(Patient::class, 'persoon_id');
    }

    public function medewerker()
    {
        return $this->hasOne(Employee::class, 'persoon_id');
    }
}
