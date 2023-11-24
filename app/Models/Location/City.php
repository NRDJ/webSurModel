<?php

namespace App\Models\Location;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\Person;
use App\Models\Event\Event;
use App\Models\Location\Region;

class City extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'region_id'
    ];

    public function region(){
        return $this->belongsTo(Region::class);
    }

    public function people()
    {
        return $this->hasMany(Person::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
