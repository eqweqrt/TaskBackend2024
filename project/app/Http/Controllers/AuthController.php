<?php

namespace App\Http\Controllers;

use App\Action\User\LoginUserAction;
use App\Action\User\LogoutUserAction;
use App\Action\User\RegistrationUserAction;
use App\DataTransferObject\User\LoginData;
use App\DataTransferObject\User\RegistrationData;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
