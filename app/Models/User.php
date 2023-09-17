<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use App\Models\Scopes\Searchable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;
    use HasFactory;
    use Searchable;
    use HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone _number',
        'roll_id',
        'userable_id',
        'userable_type',
    ];

    protected $searchableFields = ['*'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roll()
    {
        return $this->belongsTo(Roll::class);
    }

    public function allDonationDetales()
    {
        return $this->hasMany(DonationDetales::class);
    }

    public function scoutRegiment()
    {
        return $this->morphOne(ScoutRegiment::class, 'scout_regimentable');
    }

    public function userable()
    {
        return $this->morphTo();
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super-admin');
    }
}
