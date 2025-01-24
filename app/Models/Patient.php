<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice;
use App\Models\Person;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients'; // Ensure the table name is correct

    protected $primaryKey = 'id'; // Ensure the primary key is correct

    public $timestamps = false;

    protected $fillable = [
        'person_id',
        'number',
        'medical_file',
    ];

    public function getFullNameAttribute()
    {
        return $this->person->name;
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }
}
