<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\Person;

class SocialNetwork extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function people()
    {
        return $this->belongsToMany(Person::class,'person_has_socialnetworks');
    }
}
