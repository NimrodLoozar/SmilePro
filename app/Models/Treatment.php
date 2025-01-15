<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Treatment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'employee_id',
        'date',
        'time',
        'treatment_type',
        'description',
        'cost',
        'status',
        'is_active',
        'comment',
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime',
        'cost' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('date', '>=', now())->orderBy('date', 'asc');
    }

    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    // Helper methods
    public function isUpcoming(): bool
    {
        return $this->date->isFuture();
    }

    public function isPast(): bool
    {
        return $this->date->isPast();
    }

    public function isToday(): bool
    {
        return $this->date->isToday();
    }

    public function getFormattedCostAttribute(): string
    {
        return '€' . number_format($this->cost, 2);
    }

    public function getFullDateTimeAttribute(): string
    {
        return $this->date->format('Y-m-d') . ' ' . $this->time->format('H:i');
    }
}