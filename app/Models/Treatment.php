<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice;

class Treatment extends Model
{
    /** @use HasFactory<\Database\Factories\TreatmentFactory> */
    use HasFactory;

    protected $table = 'treatments';

    protected $primaryKey = 'id';
    
    public $timestamps = false;

    protected $fillable = ['treatment_type'];

    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }
}
