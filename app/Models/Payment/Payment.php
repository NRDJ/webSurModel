<?php

namespace App\Models\Payment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\PersonRequest;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'discount',
        'honorary_ticket',
        'pay_day',
        'transfer_voucher',
        'person_request_id'
    ];

    public function person_request(){
        return $this->belongsTo(PersonRequest::class);
    }
}
