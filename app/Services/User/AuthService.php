<?php

namespace App\Services\User;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Response;
use Laravel\Passport\TokenRepository;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class AuthService
{
    public function register($request)
    {
        $date_of_origination = Carbon::parse($request->date_of_origination)->format('y-m-d');
        if ( $request->hasFile('logo_url')) {
            $logo = $request->file('logo_url');
            $image_name = date('YmdHi') . $logo->getClientOriginalName();
            $logo->move(public_path('/images/businessInfo'), $image_name);
        }

        $user = User::create([

            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password,
            'company_name' => $request->company_name,
            'phone' => $request->phone,
            'business_fax' => $request->business_fax,
            "logo_url" => '/images/businessInfo/' . $image_name,
            'address' => $request->address,
            'date_of_origination' => $date_of_origination,
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
