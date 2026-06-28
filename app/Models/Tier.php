<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'daily_roi',
        'duration',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'daily_roi' => 'decimal:2',
        'duration' => 'integer',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function investments(): HasMany
    {
        return $this->hasMany(Investment::class);
    }
}
