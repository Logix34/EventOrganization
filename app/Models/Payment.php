<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\DocBlock\Description;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
       'name',
       'user_id',
       'stripe_token',
       'card_number',
       'cvc',
       'description',
       'amount',
       'expiry_month',
       'expiry_year'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
