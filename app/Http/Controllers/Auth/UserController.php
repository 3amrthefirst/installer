<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    //
    protected $service;
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
    public function index()
    {
        $result = $this->service->index();
        return Response::successResponse($result);
    }
    public function paginate()
    {
        $result = $this->service->indexPaginate();
        return Response::successResponse($result);
    }
    public function user()
    {
        $result = $this->service->user();
        return Response::successResponse($result);
    }
    public function show($id)
    {
        $result = $this->service->show($id);
        return Response::successResponse($result);
    }
    public function update(Request $request , $id)
    {
        $result = $this->service->update($request,$id);
        return Response::successResponse($result);

    }

    public function destroy($id)
    {
        $result = $this->service->destroy($id);
        return Response::successResponse($result);
    }
    public function search(Request $request){
        $result = $this->service->search($request->name , $request->email);
        return Response::successResponse($result);
    }

    public function userByState(Request $request){
        $result = $this->service->userByState($request->state);
        return Response::successResponse($result);
    }

}
