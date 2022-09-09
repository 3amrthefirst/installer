<?php

namespace App\Http\Controllers;

use App\Services\Adders\AdderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class AddersController extends Controller
{
    protected $services ;
    public function __construct(AdderService $service)
    {
        $this->services = $service ;
    }
    public function index()
    {
        $result = $this->services->index();
        return Response::successResponse($result);
    }
    public function indexPaginate()
    {
       $result = $this->services->indexPaginate();
        return Response::successResponse($result);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name' => 'required | string'
        ]);
        if ($validation -> fails()){
            return Response::errorResponse($validation->errors());
        }
        $result = $this->services->store($request);
        return Response::successResponse($result);
    }

    public function show($id)
    {
        $result = $this->services->show($id);
        return Response::successResponse($result);
    }
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(),[
            'name' => 'string'
        ]);
        if ($validation -> fails()){
            return Response::errorResponse($validation->errors());
        }
        $result = $this->services->update( $request , $id);
        return Response::successResponse($result);
    }
    public function destroy($id)
    {
        $result = $this->services->destroy($id);
        return Response::successResponse($result);
    }
}
