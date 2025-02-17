<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice;
use App\Models\Person;
use Illuminate\Support\Facades\DB;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients'; // Ensure the table name is correct

    protected $primaryKey = 'id'; // Ensure the primary key is correct

    public $timestamps = false;

    protected $fillable = [
        'name',
        'number',
        'medical_file',
        'is_active',
        'comment',
    ];
    public function getPatient($patient)
    {
        DB::table('patients')
            ->join('people', 'patients.person_id', '=', 'people.id')
            ->select('patients.*', 'people.name')
            ->where('patients.id', $patient->id)
            ->first();
    }


    protected $casts = [
        'is_active' => 'boolean',
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
