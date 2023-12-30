<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(protected UserService $userService)
    {
    }


    public function store(Request $request)
    {
//      dd("hello laravel");
        $user = $this->userService->createUser($request->all());

        $usertoken=$this->userService->createToken($user);
        $user->setRememberToken($usertoken);
        return response($usertoken, 201);
    }
    public function update()
    {

    }

    public function login(Request $request)
    {
        $user = $this->userService->login($request->all());
        $resp=['user'=> __($user->getAttribute('username')),'message' => __('Logged in successfully')];
        $token=$this->userService->createToken($user);
        return response(json_encode(array($resp,$token)),210);
    }

    public function logout(Request $request)
    {
        $this->userService->logout(auth()->user());
        return response(['message' => __('Logged out successfully')],210);
    }
}
