<?php

namespace App\Action\User;

use App\DataTransferObject\User\LoginData;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;

class LoginUserAction
{
    public static function execute(LoginData $data): array
    {
        $user = User::query()->where('email', '=', $data->email)->first();

        throw_if(is_null($user), new HttpResponseException(response()->json(['message' => 'Auth failed'], 401)));
        throw_unless(Hash::check($data->password, $user->password), new HttpResponseException(response()->json(['message' => 'Auth failed'], 401)));

        $token = $user->createToken('my-app-token')->plainTextToken;

        return ['user' => $user, 'token' => $token];
    }
}
