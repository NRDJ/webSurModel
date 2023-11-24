<?php

namespace App\Models\User;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Location\Country;
use App\Models\Location\City;
use App\Models\User\Feature;
use App\Models\User\Photo;
use App\Models\User\Profile;
use App\Models\Payment\TransferAccount;
use App\Models\Event\Publication;
use App\Models\User\PersonRequest;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'rut',
        'name',
        'last_name',
        'gender',
        'birth_date',
        'phone',
        'instagram',
        'user_id',
        'country_id',
        'city_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    
    public function features(){
        return $this->hasOne(Feature::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function soicalNetworks()
    {
        return $this->belongsToMany(Person::class,'person_has_socialnetworks');
    }

    public function profiles()
    {
        return $this->belongsToMany(Profile::class,'assigned_profiles');
    }

    public function transfer_account(){
        return $this->hasOne(TransferAccount::class);
    }

    // public function person_request()
    // {
    //     return $this->hasMany(PersonRequest::class);
    // }

    public function person_request()
    {
        return $this->belongsToMany(Publication::class,'person_requests')->using(PersonRequest::class)->withPivot('state');
    }

    public function getAge()
    {
        return Carbon::parse($this->attributes['birth_date'])->age;
    }

    public function getBirthDate()
    {
        return Carbon::parse($this->attributes['birth_date'])->format('d-m-Y');
    }
}
