<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Office;

class Internship extends Model
{
    use HasFactory;

    // Ubah nama tabel
    protected $table = 'pkl_internships';

    protected $fillable = [
        'user_id',
        'guru_pembimbing_id',
        'office_id',
        'start_date',
        'end_date',
        'position',
        'description',
        'status',
        'phone',
        'company_leader',
        'company_type',
        'company_phone',
        'company_description'
    ];

    public function guruPembimbing()
    {
        return $this->belongsTo(User::class, 'guru_pembimbing_id');
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}