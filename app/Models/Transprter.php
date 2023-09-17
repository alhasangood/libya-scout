<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transprter extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'identity',
        'photo',
        'address',
        'transprter_type_id',
    ];

    protected $searchableFields = ['*'];

    public function item()
    {
        return $this->belongsTo(TransprterType::class, 'transprter_type_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
