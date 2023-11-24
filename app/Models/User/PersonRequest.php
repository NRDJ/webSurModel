<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\Payment\Payment;
use App\Models\Event\Publication;
use App\Models\User\Person;

// class PersonRequest extends Model
class PersonRequest extends Pivot
{
    use HasFactory;

    protected $table = 'person_requests';

    protected $fillable = [
        'person_id',
        'publication_id',
        'state'
    ];

    public function payment(){
        return $this->hasOne(Payment::class,'person_request_id','id');
    }

    public function publication(){
        return $this->belongsTo(Publication::class);
    }

    public function person(){
        return $this->belongsTo(Person::class);
    }
}
