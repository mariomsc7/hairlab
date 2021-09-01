<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        "start_time", "end_time", "comments", "tot_paid"
    ];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }
    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }
    public function services()
    {
        return $this->belongsToMany('App\Service');
    }
}