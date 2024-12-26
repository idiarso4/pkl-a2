<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Journal extends Model
{
    protected $table = 'pkl_journals';

    protected $fillable = [
        'internship_id',
        'date',
        'activity',
        'description',
        'status',
        'notes'
    ];

    protected $casts = [
        'date' => 'date'
    ];

    public function internship(): BelongsTo
    {
        return $this->belongsTo(Internship::class, 'internship_id');
    }
} 