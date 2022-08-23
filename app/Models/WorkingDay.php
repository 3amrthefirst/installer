<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingDay extends Model
{
    use HasFactory;
    protected $table = "working_days";
    public $timestamps = true;
    protected $fillable = [
      'user_id',
      'day_id',
    ];

    protected $hidden =[
        'created_at',
        'updated_at',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function day(){
        return $this->belongsTo(Day::class,'day_id');
    }
}
