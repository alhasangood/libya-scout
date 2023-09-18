<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donation extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'status', 'donation_detales_id', 'order_id'];

    protected $searchableFields = ['*'];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function donationDetales()
    {
        return $this->belongsTo(DonationDetales::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
