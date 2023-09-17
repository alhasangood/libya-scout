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
        'name',
        'person',
        'logo',
        'phone_number',
        'user_id',
        'donation_entity_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'donation_detales';

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function donationEntity()
    {
        return $this->belongsTo(DonationEntity::class);
    }
}
