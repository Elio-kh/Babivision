<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'eye',
        'sphere',
        'cylinder',
        'axis',
        'add',
        'issued_at'
    ];

    protected $casts = [
        'issued_at' => 'date',
        'sphere' => 'decimal:2',
        'cylinder' => 'decimal:2',
        'add' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
