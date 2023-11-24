<?php

namespace App\Models\Event;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\Sponsor;
use App\Models\Event\Publication;
use App\Models\Location\City;

class Event extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'path_image',
        'slug',
        'description',
        'start_date',
        'end_date',
        'number_days',
        'start_time',
        'time_end',
        'state',
        'sponsor_id',
        'city_id'
    ];

    public function sponsor(){
        return $this->belongsTo(Sponsor::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function publications()
    {
        return $this->hasMany(Publication::class);
    }

    public function getStartDate(){
        return Carbon::parse($this->attributes['start_date'])->format('d M');
    }

    public function getDateEnd(){
        return Carbon::parse($this->attributes['end_date'])->format('d M');
    }

    public function getStartTime(){
        return Carbon::parse($this->attributes['start_time'])->format('h:i A');
    }

    public function getTimeEnd(){
        return Carbon::parse($this->attributes['time_end'])->format('h:i A');
    }
}
