<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Requests\Auth\AuthRegisterRequest;
use App\Services\User\AuthService;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
    protected $service;
    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }
    public function register(AuthRegisterRequest $request)
    {
        $result = $this->service->register($request);
        return Response::successResponse($result);
    }
    public function login(AuthLoginRequest $request)
    {
        $result = $this->service->login($request);
        return Response::successResponse($result);
    }
    public function logout()
    {
       $result =  $this->service->logout();
       return Response::successResponse($result);
    }

    }
