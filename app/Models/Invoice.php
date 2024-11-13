<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'behandeling_id',
        'nummer',
        'datum',
        'bedrag',
        'status',
        'isactief',
        'opmerking',
        'datumaangemaakt',
        'datumgewijzigd',
    ];

    /**
     * Define relationships with Patient and Behandeling.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function behandeling()
    {
        return $this->belongsTo(Treatment::class, 'behandeling_id');
    }
}
