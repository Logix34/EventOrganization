<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [

        'booking_date',
        'event_id',
        'select_tables',
        'select_tickets',
        'transaction_id',
        'transaction_id',
        'transaction_date',
        'amount'

    ];
    public function event()
    {
        return $this->belongsTo('App\Models\Event','event_id');
    }
}
