<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessInfo\BusinessCreateRequest;
use App\Http\Requests\BusinessInfo\BusinessUpdateRequest;
use App\Services\BusinessInfo\BusinessInfoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class BusinessInfoController extends Controller
{
    //
    protected $services;
    public function __construct(BusinessInfoService $service)
    {
        $this->services = $service;
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
    public function store(BusinessCreateRequest $request)
    {
        $result = $this->services->store($request);
        return Response::successResponse($result);
    }
    public function show($id)
    {
        $result = $this->services->show($id);
        return Response::successResponse($result);
    }
    public function update(BusinessUpdateRequest $request,$id)
    {
        $result = $this->services->update($request,$id);
        return Response::successResponse($result);
    }
    public function destroy($id)
    {
        $result = $this->services->destroy($id);
        return Response::successResponse($result);
    }
    public function search()
    {
        $result = $this->services->search();
    }
}
