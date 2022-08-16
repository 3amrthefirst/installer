<?php

namespace App\Services\User;

use App\Http\Resources\PaginationResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;


class UserService
{

    public function index(){
        $users = User::all();
        return $users;
    }

    public function indexPaginate(){
        $users = User::paginate(10);
        return $users;
    }

    public function user(){
        return Auth::user();
    }

    public function show($id){
        $user = User::findOrFail($id);
            return $user;
    }

    public function update(Request $request , $id){
        $user = $this->show($id);
        $data = $user->update($request->all());
        return $data ;
    }
    public function destroy($id){

        $user = $this->show($id);
        $user->delete();
            return Response::successResponse([],"user deleted");
        }

        public function search(){

        }
}
