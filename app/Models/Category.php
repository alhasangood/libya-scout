<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['donation_id', 'item_id'];

    protected $searchableFields = ['*'];

    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
