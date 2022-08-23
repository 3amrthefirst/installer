<?php

namespace App\Http\Controllers;

use App\Services\workingDays\WorkingDaysServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class workingDaysController extends Controller
{
    //
    public $services;
    public function __construct(WorkingDaysServices $service){
         $this->services = $service ;
    }

    public function index(){
        $result = $this->services->index();
        return Response::successResponse($result);
    }

    public function indexPaginate(){
        $result = $this->services->indexPaginate();
        return Response::successResponse($result);
    }

    public function indexAuthUser(){
        $result = $this->services->indexAuthUser();
        return Response::successResponse($result);
    }

    public function indexUser($id){
        $result = $this->services->indexUser($id);
        return Response::successResponse($result);
    }

    public function indexDay($id){
        $result = $this->services->indexDay($id);
        return Response::successResponse($result);
    }

    public function show($id){
        $result = $this->services->show($id);
        return Response::successResponse($result);
    }

    public function store(Request $request ){
        $validation = Validator::make($request->all(),[
            'day_id' => 'required',
            'day_id.*' => 'numeric | in:1,2,3,4,5,6,7'
        ]);
        if ($validation -> fails()){
            return Response::errorResponse($validation->errors());
        }
        $result = $this->services->store($request);
        return Response::successResponse($result);
    }

    public function update(Request $request ){
        $validation = Validator::make($request->all(),[
            'day_id.*' => 'numeric | in:1,2,3,4,5,6,7'
        ]);
        if ($validation -> fails()){
            return Response::errorResponse($validation->errors());
        }
        $result = $this->services->update($request);
        return Response::successResponse($result);
    }

    public function destroy($id){
        $result = $this->services->destroy($id);
        return Response::successResponse($result);
    }

    public function search(){
        $result = $this->services->search();
        return Response::successResponse($result);
    }

}
