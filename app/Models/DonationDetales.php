<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DonationDetales extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'donation_entity_id',
        'name',
        'person',
        'logo',
        'number',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'donation_detales';

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function donationEntity()
    {
        return $this->belongsTo(DonationEntity::class);
    }
}
