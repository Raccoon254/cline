<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'project_id',
        'status', // 'active', 'completed', 'archived', 'pending', 'cancelled', 'in_progress'
        'description',
        'price',
        'start_date',
        'end_date',
        'user_id',
        'client_id',
    ];

    //casts
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function progress(): int
    {
        $now = now();
        $start = $this->start_date;
        $end = $this->end_date;

        if ($now < $start) {
            return 0;
        } elseif ($now > $end) {
            return 100;
        } else {
            $totalDays = $end->diffInDays($start);
            $elapsedDays = $now->diffInDays($start);
            return round(($elapsedDays / $totalDays) * 100);
        }
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}
