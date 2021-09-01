<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        "name", "price"
    ];

    public function appointments() {
        return $this->belongsToMany('App\Appointment');
    }
}
