<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [

        'event_type',
        'organiser_name',
        'organiser_phone_number',
        'event_detail',
        'event_start',
        'event_end',
        'is_delete',
    ];
    public function eventSpeakers()
    {
        return $this->hasMany('App\Models\EventSpeaker','event_id');
    }

}
