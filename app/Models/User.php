<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'current_team_id',
        'profile_photo_path',
        'is_first_login',
        'force_password_change',
        'password_changed_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_first_login' => 'boolean',
        'force_password_change' => 'boolean',
        'password_changed_at' => 'datetime'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the URL to the user's profile photo.
     * Overrides default Jetstream implementation if needed
     */
    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo_path
            ? \Illuminate\Support\Facades\Storage::url($this->profile_photo_path)
            : $this->defaultProfilePhotoUrl();
    }

    /**
     * AdminLTE integration - Profile image
     */
    public function adminlte_image()
    {
        return $this->profile_photo_url;
    }

    /**
     * AdminLTE integration - Profile URL
     */
    public function adminlte_profile_url()
    {
        return route('profile.show');
    }

    /**
     * Determina si el usuario requiere cambio de contraseña
     */
    public function requiresPasswordChange(): bool
    {
        return $this->is_first_login === false || $this->force_password_change === true;
    }

    /**
     * Marca al usuario como requerido para cambiar contraseña
     */
    public function requirePasswordChange(): void
    {
        $this->update([
            'is_first_login' => false,
            'force_password_change' => true
        ]);
    }

    /**
     * Registra el cambio de contraseña exitoso
     */
    public function passwordChanged(): void
    {
        $this->update([
            'is_first_login' => true,
            'force_password_change' => false,
            'password_changed_at' => now()
        ]);
    }

    public function passwordExpired()
{
    return $this->password_changed_at->diffInDays(now()) > 90;
}

}