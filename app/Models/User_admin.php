<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_admin extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'email_verified',
        'email_token',
        'password',
    ];
}
