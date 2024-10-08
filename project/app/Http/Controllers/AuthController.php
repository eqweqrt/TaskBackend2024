<?php

namespace project\app\Http\Controllers;

use project\app\Action\User\LoginUserAction;
use project\app\Action\User\LogoutUserAction;
use project\app\Action\User\RegistrationUserAction;
use project\app\DataTransferObject\User\LoginData;
use project\app\DataTransferObject\User\RegistrationData;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;use project\app\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function signup(RegistrationData $data): JsonResponse
    {
        $response = RegistrationUserAction::execute($data);
        return response()->json(['user_token' => $response['token']], 201);
    }

    public function login(LoginData $data): JsonResponse
    {
        $response = LoginUserAction::execute($data);
        return response()->json(['user_token' => $response['token']], 200);
    }

    public function logout(Request $request): JsonResponse
    {
        LogoutUserAction::execute();
        return response()->json(['message' => 'logout'], 200);
    }
}
