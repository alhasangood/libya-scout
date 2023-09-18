<?php

namespace App\Models;

use App\Models\User;
use App\Models\Order;
use App\Models\StoreHouse;
use App\Models\ScoutRegiment;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScoutCommission extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'phone',
        'status',
        // 'store_house_id',
        // 'order_id',
        // 'user_id',
        // 'scout_regiment_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'scout_commissions';

    public function storeHouse()
    {
        return $this->belongsTo(StoreHouse::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scoutRegiment()
    {
        return $this->belongsTo(ScoutRegiment::class);
    }

    public function users(): MorphOne
    {
        return $this->morphOne(user::class, 'userable');
    }
}
