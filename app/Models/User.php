<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
        "email",
        "profile_picture",
        "role",//user,client,admin
        "phone_number",
        "password",
        "last_login_at",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ["password", "remember_token"];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        "email_verified_at" => "datetime",
        "password" => "hashed",
    ];

    public function client(): HasOne
    {
        return $this->hasOne(Client::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    //get attribute profile_picture
    public function getProfilePictureAttribute(): string
    {
        //if the profile picture is not null return the profile picture
        if ($this->attributes["profile_picture"] !== null) {
            return $this->attributes["profile_picture"];
        }
        return "https://api.dicebear.com/8.x/identicon/svg?seed=" . $this->name;
    }

    public function skills(): hasMany
    {
        return $this->hasMany(UserSkill::class);
    }

    public function certifications(): hasMany
    {
        return $this->hasMany(UserCertification::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'recipient_id')
            ->orWhere('sender_id', $this->id);
    }
}
