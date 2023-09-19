<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreHouse extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name','scout_regiment_id'];

    protected $searchableFields = ['*'];

    protected $table = 'store_houses';

    public function scoutRegiment()
    {
        return $this->belongsTo(ScoutRegiment::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
    
}
