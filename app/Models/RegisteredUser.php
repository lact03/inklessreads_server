<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisteredUser extends Model
{
    use HasFactory;

    protected $table = 'registered_users';

    protected $fillable = [
        'first_name',
        'last_name',
        'age',
        'email',
        'password',
        'mobile_number'
    ];
}
