<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'recipient_id',
        'body',
        'is_read',
        'sent_at',
        'delivered_at',
        'read_at',
        'attachment_path',
        'attachment_type'
    ];

    protected $appends = ['time'];

    protected array $dates = ['sent_at', 'delivered_at', 'read_at'];

    protected $casts = [
        'is_read' => 'boolean',
        'sent_at' => 'datetime',
        'delivered_at' => 'datetime',
    ];

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function recipient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    //time attribute, if more than 1 hr, show date
    public function getTimeAttribute(): string
    {
        $time = $this->sent_at->diffForHumans();
        if ($this->sent_at->diffInHours() > 1) {
            $time = $this->sent_at->format('M d, Y');
        }
        return $time;
    }
}
