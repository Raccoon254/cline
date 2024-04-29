<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'client_id');
    }

    public function getNameAttribute(): string
    {
        return $this->user->name;
    }

    public function getEmailAttribute(): string
    {
        return $this->user->email;
    }

    public function getRoleAttribute(): string
    {
        return $this->user->role;
    }

    public function getPhoneNumberAttribute(): string
    {
        return $this->user->phone_number;
    }

    public function getPasswordAttribute(): string
    {
        return $this->user->password;
    }

    public function getLastLoginAtAttribute(): string
    {
        return $this->user->last_login_at;
    }

    public function getProfilePictureAttribute(): string
    {
        return "https://api.dicebear.com/8.x/identicon/svg?seed=" . $this->user->name;
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}
