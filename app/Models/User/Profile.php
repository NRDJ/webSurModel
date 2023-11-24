<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Event\Publication;
use App\Models\User\Person;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function people()
    {
        return $this->belongsToMany(Person::class,'assigned_profiles');
    }

    public function publications()
    {
        return $this->hasMany(Publication::class);
    }
}
