<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['orederNumber', 'from', 'to'];

    protected $searchableFields = ['*'];

    public function scoutCommissions()
    {
        return $this->hasMany(ScoutCommission::class);
    }

    public function scoutRegiments()
    {
        return $this->hasMany(ScoutRegiment::class);
    }

    public function transprters()
    {
        return $this->hasMany(Transprter::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}
