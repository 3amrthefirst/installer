<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessLicense extends Model
{
    use HasFactory;

    protected $table = 'business_licenses';
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'license_number',
        'license_img',
        'license_type',
        'state',
        'license_expiration_date',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id' , 'id');
    }
}
