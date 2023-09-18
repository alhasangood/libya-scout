<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Traits\FilamentTrait;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser
{
    use HasRoles;
    use Notifiable;
    use HasFactory;
    use Searchable;
    use HasApiTokens;
    use FilamentTrait;

    protected $fillable = ['name', 'email', 'password', 'phone_number'  , 
    'scout_regiment_id'];

    protected $searchableFields = ['*'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
    // public function userable(): MorphTo
    // {
    
    //     return $this->morphTo(__FUNCTION__, 'userable_type', 'userable_id');
    // }

    public function order()
    {
        return $this->hasOne(Roll::class, 'user_id');
    }

    public function scoutCommission()
    {
        return $this->hasOne(ScoutCommission::class);
    }
    public function scoutRegiment()
    {
        return $this->hasOne(ScoutRegiment::class);
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super-admin');
    }
}
