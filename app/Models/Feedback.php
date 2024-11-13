<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'medewerker_id',
        'beoordeling',
        'isactief',
        'opmerking',
        'datumaangemaakt',
        'datumgewijzigd',
    ];

    /**
     * Define relationships with Patient and Medewerker.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function medewerker()
    {
        return $this->belongsTo(Employee::class, 'medewerker_id');
    }
}
