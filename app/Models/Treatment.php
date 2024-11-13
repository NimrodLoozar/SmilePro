<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    protected $fillable = [
        'medewerker_id',
        'datum',
        'tijd',
        'omschrijving',
        'kosten',
        'status',
        'isactief',
        'opmerking',
        'datumaangemaakt',
        'datumgewijzigd',
    ];

    /**
     * Define the relationship with Medewerker.
     */
    public function medewerker()
    {
        return $this->belongsTo(Employee::class, 'medewerker_id');
    }
}
