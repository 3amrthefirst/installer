<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;
    protected $table = 'days';
    public $timestamps = true;
    protected $fillable = [
        'name'
    ];
    protected $hidden =[
        'created_at',
        'updated_at',
    ];

    public function workingdyas(){
        return $this->belongsToMany(User::class,'working_days');
    }

    public function Users(){
        return $this->belongsToMany(User::class,'working_days','day_id','user_id','id','id');
    }

}
