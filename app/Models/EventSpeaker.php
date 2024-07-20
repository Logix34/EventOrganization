<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSpeaker extends Model
{
    protected $fillable = [

       'first_name',
        'last_name',
        'email',
        'event_id',
        'phone_number',
        'gender',
        'facebook_url',
        'twitter_url',
        'linkedin_url',
        'date',
    ];
}
