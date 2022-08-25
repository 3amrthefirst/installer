<?php

namespace App\Models;

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

    // business info relation
    public function business_info(){
        return $this->hasOne(BusinessInfo::class,'user_id');
    }
    public function business_licence(){
        return $this->hasOne(BusinessLicense::class,'user_id');
    }
    public function Days(){
        return $this->belongsToMany(Day::class,'working_days','user_id','day_id','id','id');
    }
    public function Adders(){
        return $this->belongsToMany(Adder::class,'installer_adders','user_id','adder_id','id','id')->withPivot('price','unit');
    }
}
