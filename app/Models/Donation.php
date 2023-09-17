<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donation extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'description',
        'qtuantity',
        'donation_detales_id',
        'item_id',
        'store_house_id',
    ];

    protected $searchableFields = ['*'];

    public function donationDetales()
    {
        return $this->belongsTo(DonationDetales::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function storeHouse()
    {
        return $this->belongsTo(StoreHouse::class);
    }
}
