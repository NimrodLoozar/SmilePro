<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'persoon_id',
        'nummer',
        'medischdossier',
        'isactief',
        'opmerking',
        'datumaangemaakt',
        'datumgewijzigd',
    ];

    /**
     * Define the relationship with Persoon.
     */
    public function persoon()
    {
        return $this->belongsTo(Person::class, 'persoon_id');
    }

    /**
     * Define the relationship with Contact.
     */
    public function contact()
    {
        return $this->hasOne(Contact::class, 'patient_id');
    }
}
