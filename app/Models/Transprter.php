<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transprter extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'identity', 'photo', 'address', 'order_id', 'transprter_type_id'];

    protected $searchableFields = ['*'];

 
    public function transprter()
    {
        return $this->belongsTo(Transprter::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
