<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['date', 'number'];

    public function merchant()
    {
        return $this->belongsTo('App\Merchant');
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function dealing()
    {
        return $this->hasOne('App\Dealing');
    }
}
