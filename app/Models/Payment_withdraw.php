<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment_withdraw extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'amount',
        'bank_name',
        'payment_method',
        'card_name',
        'card_no',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
