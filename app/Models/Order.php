<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['transprter_id'];

    protected $searchableFields = ['*'];

    public function transprter()
    {
        return $this->belongsTo(Transprter::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }

    public function storeHouses()
    {
        return $this->belongsToMany(StoreHouse::class);
    }
}
