<?php

namespace App\Models\User;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\Person;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo_path',
        'confirmed',
        'person_id'
    ];

    public function person(){
        return $this->belongsTo(Person::class);
    }

    public function uploadedAgo(){
        return Carbon::parse($this->attributes['created_at'])->diffForHumans();
    }
}
