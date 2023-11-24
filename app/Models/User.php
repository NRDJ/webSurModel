<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

use App\Models\User\Person;
use App\Models\User\Sponsor;
use App\Models\Role;
use Carbon\Carbon;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function sponsor(){
        return $this->hasOne(Sponsor::class);
    }
    
    public function person(){
        return $this->hasOne(Person::class);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function createdAgo(){
        return Carbon::parse($this->attributes['created_at'])->diffForHumans();
    }

    public function verifiedAgo(){
        return Carbon::parse($this->attributes['email_verified_at'])->diffForHumans();
    }

    public function uploadedAgo(){
        return Carbon::parse($this->attributes['uploaded_at'])->diffForHumans();
    }

}

