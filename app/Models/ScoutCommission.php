<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScoutCommission extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'phone_number',
        'scout_commissionable_id',
        'scout_commissionable_type',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'scout_commissions';

    public function scoutRegiments()
    {
        return $this->hasMany(ScoutRegiment::class);
    }

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function scoutCommissions()
    {
        return $this->morphMany(ScoutCommission::class, 'scout_commissionable');
    }

    public function scout_commissionable()
    {
        return $this->morphTo();
    }
}
