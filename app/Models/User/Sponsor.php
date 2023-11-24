<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Event\Event;

class Sponsor extends Model
{
    use HasFactory;

    protected $fillable = [
        'rut',
        'business_name',
        'main_line',
        'commercial_address',
        'logo',
        'contact_name',
        'contact_phone',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function eventos()
    {
        return $this->hasMany(Event::class);
    }
}
