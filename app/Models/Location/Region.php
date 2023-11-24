<?php

namespace App\Models\Location;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Location\City;

class Region extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'slug',
        'ordinal'
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
