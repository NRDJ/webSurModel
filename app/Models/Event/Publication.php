<?php

namespace App\Models\Event;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\Profile;
use App\Models\Event\Event;
use App\Models\User\PersonRequest;
use App\Models\User\Person;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = [
        'remuneration',
        'amount',
        'collation',
        'state',
        'date',
        'start_time',
        'time_end',
        'event_id',
        'profile_id'
    ];

    public function event(){
        return $this->belongsTo(Event::class);
    }

    public function profile(){
        return $this->belongsTo(Profile::class);
    }

    public function person_request()
    {
        return $this->belongsToMany(Person::class,'person_requests')->using(PersonRequest::class)->withPivot('state');
    }

    public function getDate(){
        return Carbon::parse($this->attributes['date'])->format('d M');
    }

    public function getStartTime(){
        return Carbon::parse($this->attributes['start_time'])->format('h:i A');
    }

    public function getTimeEnd(){
        return Carbon::parse($this->attributes['time_end'])->format('h:i A');
    }
}
