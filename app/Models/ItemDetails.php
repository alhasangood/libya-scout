<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemDetails extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['item_id', 'name'];

    protected $searchableFields = ['*'];

    protected $table = 'item_details';

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
