<?php

namespace App\Http\Controllers;

use App\Services\Jobs\JobsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class WorkOrderController extends Controller
{
    //

    protected $services ;
    public function __construct(JobsService $service)
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
        $result = $this->services->store($request);
        return Response::successResponse($result);
    }

    public function show($id)
    {
        $result = $this->services->show($id);
        return Response::successResponse($result);
    }
    public function destroy($id)
    {
        $result = $this->services->destroy($id);
        return Response::successResponse($result);
    }
}
