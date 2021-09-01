<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        "name", "last_name", "phone_number", "email"
    ];

    public function appointments() {
        return $this->hasMany('App\Appointment');
    }

}
