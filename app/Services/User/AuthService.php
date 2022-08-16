<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Response;
use Laravel\Passport\TokenRepository;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class AuthService
{
    public function register($request)
    {
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password,
        ]);

        $user['token'] = $user->createToken('passport_token')->accessToken;
        return Response::successResponse($user);

    }

    public function login($request)
    {
        $user = User::where('email', $request->email)
            ->first();
        if (!$user) {
            throw new BadRequestHttpException(Lang::get('messages.'));
        }
        $user->validateForPassportPasswordGrant($request->password);
        $user['token'] = $user->createToken('passport_token')->accessToken;
        return $user;
    }

    public function logout()
    {
        $token = auth()->user()->token();

        $tokenReposetory = app(TokenRepository::class);
        $tokenReposetory->revokeAccessToken($token->id);

        return Response::successResponse([], "logout success");
    }

    public function verify($request)
    {

    }
}
