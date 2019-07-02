<?php

namespace App;

use App\Notifications\Merchant\MerchantResetPassword;
use App\Notifications\Merchant\MerchantVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Merchant extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'opens_at', 'closes_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MerchantResetPassword($token));
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new MerchantVerifyEmail);
    }

    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }

    public function dealings()
    {
        return $this->hasManyThrough('App\Dealing', 'App\Booking');
    }

    public function setOpensAtAttribute($value)
    {
        if (substr($value, -2) == 'PM') {
            $hour = substr($value, 0, 2);

            if ($hour != '12') {
                $this->attributes['opens_at'] = str_replace($hour, (intval($hour) + 12), $value);
            } else {
                $this->attributes['opens_at'] = $value;
            }
        } else {
            $hour = substr($value, 0, 2);

            if ($hour == '12') {
                $this->attributes['opens_at'] = str_replace($hour, (intval($hour) - 12), $value);
            } else {
                $this->attributes['opens_at'] = $value;
            }
        }
    }

    public function setClosesAtAttribute($value)
    {
        if (substr($value, -2) == 'PM') {
            $hour = substr($value, 0, 2);

            if ($hour != '12') {
                $this->attributes['closes_at'] = str_replace($hour, (intval($hour) + 12), $value);
            } else {
                $this->attributes['closes_at'] = $value;
            }
        } else {
            $hour = substr($value, 0, 2);

            if ($hour == '12') {
                $this->attributes['closes_at'] = str_replace($hour, (intval($hour) - 12), $value);
            } else {
                $this->attributes['closes_at'] = $value;
            }
        }
    }
}
