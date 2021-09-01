<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
        protected $fillable = [
        "name", "last_name", "phone_number", "production"
    ];

    public function appointments() {
        return $this->hasMany('App\Appointment');
    }
}
