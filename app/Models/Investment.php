<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Investment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tier_id',
        'amount',
        'profit',
        'status',
        'started_at',
        'expires_at',
        'last_roi_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'profit' => 'decimal:2',
        'started_at' => 'datetime',
        'expires_at' => 'datetime',
        'last_roi_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tier(): BelongsTo
    {
        return $this->belongsTo(Tier::class);
    }
}
