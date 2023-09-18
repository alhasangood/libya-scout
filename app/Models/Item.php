<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'store_house_id'];

    protected $searchableFields = ['*'];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function allItemDetails()
    {
        return $this->hasMany(ItemDetails::class);
    }

    public function storeHouse()
    {
        return $this->belongsTo(StoreHouse::class);
    }
}
