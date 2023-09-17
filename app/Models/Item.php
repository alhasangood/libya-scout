<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'category_id'];

    protected $searchableFields = ['*'];

    public function donation()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function allItemDetails()
    {
        return $this->hasMany(ItemDetails::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
