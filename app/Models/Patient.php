<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients'; // Zorg ervoor dat de tabelnaam klopt met de database
    protected $fillable = [
        'number',       // Voeg 'number' toe als het een kolom is die je wilt bewerken
        'medical_file', 
        'is_active', 
        'comment',
    ];

    // Relatie met de Person tabel (als 'name' daar vandaan komt)
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    // Verwijder de updatePatient() methode, omdat de standaard update() al goed werkt
    // De delete() methode werkt ook standaard goed zonder deze methode.
}

