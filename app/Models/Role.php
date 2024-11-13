<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'gebruiker_id',
        'naam',
        'isactief',
        'opmerking',
        'datumaangemaakt',
        'datumgewijzigd',
    ];

    /**
     * Define the relationship with Gebruiker.
     */
    public function gebruiker()
    {
        return $this->belongsTo(User::class, 'gebruiker_id');
    }
}
