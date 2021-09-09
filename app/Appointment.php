<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        "start_time", "comment", "tot_paid", 'client_id', 'employee_id'
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
