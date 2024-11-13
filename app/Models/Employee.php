<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'persoon_id',
        'nummer',
        'medewerkertype',
        'specialisatie',
        'beschikbaarheid',
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
}
