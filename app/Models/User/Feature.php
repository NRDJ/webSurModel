<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\Person;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
        'eyes_color',
        'hair_color',
        'height',
        'weight',
        'shirt_size',
        'pants_size',
        'profession',
        'person_id'
    ];

    public function person(){
        return $this->belongsTo(Person::class);
    }
}
