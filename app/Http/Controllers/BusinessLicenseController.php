<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessLicense\licenseCreateRequest;
use App\Http\Requests\BusinessLicense\licenseUpdateRequest;
use App\Services\BusinessLicence\BusinessLicenceService;
use Illuminate\Support\Facades\Response;

class BusinessLicenseController extends Controller
{
    //
    protected $services;
    public function __construct(BusinessLicenceService $service)
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
    public function store(licenseCreateRequest $request)
    {
        $result = $this->services->store($request);
        return Response::successResponse($result);
    }
    public function show($id)
    {
        $result = $this->services->show($id);
        return Response::successResponse($result);
    }
    public function update(licenseUpdateRequest $request,$id)
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
