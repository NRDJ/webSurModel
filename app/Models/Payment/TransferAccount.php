<?php

namespace App\Models\Payment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\Person;

class TransferAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank',
        'account_type',
        'account_number',
        'person_id'
    ];

    public function person(){
        return $this->belongsTo(Person::class);
    }
}
