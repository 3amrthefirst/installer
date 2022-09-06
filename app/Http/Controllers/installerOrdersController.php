<?php

namespace App\Http\Controllers;

use App\Services\Jobs\installer_OrdersService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class installerOrdersController extends Controller
{
    protected $services ;
    public function __construct(installer_OrdersService $service)
    {
        $this->services = $service;
    }

    public function indexOrders()
    {
        $result = $this->services->indexOrders();
        return Response::successResponse($result);
    }

    public function indexInstallers()
    {
        $result = $this->services->indexInstallers();
        return Response::successResponse($result);
    }

    public function showOrders($id)
    {
        $result = $this->services->showOrders($id);
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

    public function updatePrice(Request $request , $id){
        $result = $this->services->updatePrice($request , $id);
        return Response::successResponse($result);
    }
    public function updateStatus(Request $request){
        $result = $this->services->updateStatus($request);
        return Response::successResponse($result);
    }

    public function destroy($id)
    {
        $result = $this->services->destroy($id);
        return Response::successResponse($result);
    }
}
