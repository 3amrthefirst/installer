<?php

namespace App\Http\Controllers;

use App\Services\Adders\installer_AdderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class installerAddersController extends Controller
{
    protected $services ;
    public function __construct(installer_AdderService $service)
    {
        $this->services = $service;
    }
    public function indexAdders()
    {
        $result = $this->services->indexAdders();
        return Response::successResponse($result);
    }
    public function indexInstallers()
    {
        $result = $this->services->indexInstallers();
        return Response::successResponse($result);
    }

    public function showAdder($id)
    {
        $result = $this->services->showAdder($id);
        return Response::successResponse($result);
    }
    public function showInstaller($id)
    {
        $result = $this->services->showInstaller($id);
        return Response::successResponse($result);
    }


    public function store(Request $request)
    {
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
        $result = $this->services->update($request , $id);
        return Response::successResponse($result);
    }

    public function destroy($id)
    {
        $result = $this->services->destroy($id);
        return Response::successResponse($result);
    }
}
