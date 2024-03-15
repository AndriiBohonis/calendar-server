<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
   
    protected $fillable = ['user_id','event_date', 'description','done'];

     protected static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            if (!isset($event->done)) {
                $event->done = false;
            }
        });
    }

}