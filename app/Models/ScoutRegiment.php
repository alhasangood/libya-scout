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
        'phone',
        'status',
        'scout_commission_id',
       
    ];

    protected $searchableFields = ['*'];

    protected $table = 'scout_regiments';

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
    public function scoutCommission()
    {
        return $this->belongsTo(ScoutCommission::class);
    }
}
