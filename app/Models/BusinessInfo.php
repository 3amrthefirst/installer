<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessInfo extends Model
{
    use HasFactory;
    protected $table = 'business_infos';
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'company_name',
        'phone',
        'business_fax',
        'logo_url',
        'address',
        'date_of_origination',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}
