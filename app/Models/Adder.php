<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adder extends Model
{
    use HasFactory;
    protected $table = "adders" ;
    public $timestamps = true ;
    protected $fillable = [
        'name' ,
    ];
    protected $hidden = [
        'created_at' ,
        'updated_at' ,
    ];

    public function Users(){
        return $this->belongsToMany(
            User::class,'installer_adders',
            'adder_id',
            'user_id',
            'id',
            'id')
            ->withPivot('price','unit');
    }
}
