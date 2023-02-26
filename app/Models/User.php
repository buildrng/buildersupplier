<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
// use Filament\Models\Contracts\FilamentUser;
// use Filament\Models\Contracts\HasName;
use Bavix\Wallet\Traits\HasWallet;
use Bavix\Wallet\Interfaces\Wallet;

class User extends Authenticatable implements Wallet
{
    use HasApiTokens, HasFactory, Notifiable, HasWallet;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'mobile',
        'email',
        'password',
        'type',
        'country_code',
        'cover',
        'lat',
        'lng',
        'gender',
        'verified',
        'dob',
        'date',
        'fcm_token',
        'others',
        'stripe_key',
        'status',
        'settings',
        'preferences'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'status' => 'integer',
    ];

    /**
     * Reset password notification mail.
     */
    public function sendPasswordResetNotification($token)
    {
        // $this->notify(new \App\Notifications\MailResetPasswordNotification($token));
    }

    public function canAccessFilament(): bool
    {
        // return str_ends_with($this->email, '@builder.test') && $this->hasVerifiedEmail();
            if ($this->type = 'admin' || $this->type = 'staff') {
                return true;
            }
    }

    public function getFilamentName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}