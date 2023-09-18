<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Roll extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'user_id'];
    public const admin = 1;
    public const user = 2;
    protected $searchableFields = ['*'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
