<?php

namespace App\Services\workingDays;

use App\Models\User;
use App\Models\WorkingDay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class WorkingDaysServices
{


    public function index(){
        $users = WorkingDay::with(['user' , 'day'])->get();
        return $users;
    }
    public function indexPaginate(){
        $users = WorkingDay::paginate(10);
        return $users;
    }
    public function indexAuthUser(){
        $days = WorkingDay::with(['day'])->where('user_id' , '=' , auth()->user()->id)->get();
        return $days;
    }
    public function indexUser($id){
        $days = WorkingDay::with(['day'])->where('user_id' , '=' , $id)->get();
        return $days;
    }
    public function indexDay($id){
        $users = WorkingDay::with(['user'])->where('day_id' , '=' , $id)->get();
        return $users;
    }
    public function show($id){
        $data = WorkingDay::findOrFail($id)->with(['user' , 'day'])->where('id' , '=' , $id)->get();
        return $data;
    }


    public function store(Request $request){

        $user = auth()->user();
        $WorkDays =  $user->Days()->syncWithoutDetaching($request->day_id);
        return $WorkDays;
    }
    public function edit($id)
    {
        $data = WorkingDay::findOrFail($id);
        return $data;
    }
    public function update(Request $request){
        $user = auth()->user();
        $WorkDays =  $user->Days()->sync($request->day_id);
        return $WorkDays;
    }

    public function destroy($id){
        $user = $this->edit($id);
        $user->delete();
        return "deleted";
    }

    public function search(){
        return "l";
    }
}
