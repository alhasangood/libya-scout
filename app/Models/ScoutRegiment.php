<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScoutRegiment extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'phone_number',
        'scout_regimentable_id',
        'scout_regimentable_type',
        'scout_commission_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'scout_regiments';

    public function scoutCommission()
    {
        return $this->belongsTo(ScoutCommission::class);
    }

    public function scoutRegiments()
    {
        return $this->morphMany(ScoutRegiment::class, 'scout_regimentable');
    }

    public function storeHouses()
    {
        return $this->morphMany(StoreHouse::class, 'store_houseable');
    }

    public function users()
    {
        return $this->morphMany(User::class, 'userable');
    }

    public function scout_regimentable()
    {
        return $this->morphTo();
    }
}
