<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\User;

class Role extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'key',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
