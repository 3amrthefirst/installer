<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\WorkOrder;
use App\Notifications\SendOrderEmail;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    //


    public function test(){

        $user = User::first();
        $user->notify(new SendOrderEmail());
        return $user ;

    }
}
