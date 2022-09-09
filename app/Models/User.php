<?php

namespace App\Models;

use App\Observers\installerOrdersObserver;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Laravel\Passport\HasApiTokens;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_id',
        'company_name',
        'phone',
        'business_fax',
        'logo_url',
        'address',
        'date_of_origination',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'email_verified_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }


    public function validateForPassportPasswordGrant($password)
    {
        if (!Hash::check($password, $this->password)) {

            throw new BadRequestHttpException(Lang::get('messages.'));

        }
    }

    //observer
    protected static function boot()
    {
        Parent::boot();
        User::observe(installerOrdersObserver::class);
    }



    public function business_licence(){
        return $this->hasOne(BusinessLicense::class,
            'user_id');
    }

    public function Days(){
        return $this->belongsToMany(Day::class,
            'working_days',
            'user_id',
            'day_id',
            'id',
            'id');
    }

    public function Adders(){
        return $this->belongsToMany(Adder::class,
            'installer_adders',
            'user_id',
            'adder_id',
            'id',
            'id')
            ->withPivot('price','unit');
    }

    public function Orders(){
        return $this->belongsToMany(WorkOrder::class,'installers_orders',
            'user_id',
            'job_id',
            'id',
            'id')
            ->withPivot('price','status');
    }
}
