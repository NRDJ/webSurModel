<?php

namespace App\Models\Location;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\Person;

class Country extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'demonym',
        'cod'
    ];

    public function people()
    {
        return $this->hasMany(Person::class);
    }
    
}


