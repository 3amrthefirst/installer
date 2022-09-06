<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;

    protected $table = "work_orders" ;
    public $timestamps = true ;
    protected $fillable = [
        'client_name'     ,
        'client_address'  ,
        'job_description' ,
    ];


    public function Users(){
        return $this->belongsToMany(
            User::class,'installers_orders',
            'job_id',
            'user_id',
            'id',
            'id')
            ->withPivot('price','status');
    }
}
