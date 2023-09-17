<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreHouse extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'store_houseable_id',
        'store_houseable_type',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'store_houses';

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function scoutCommission()
    {
        return $this->morphOne(ScoutCommission::class, 'scout_commissionable');
    }

    public function scoutRegiment()
    {
        return $this->morphOne(ScoutRegiment::class, 'scout_regimentable');
    }

    public function store_houseable()
    {
        return $this->morphTo();
    }
}
