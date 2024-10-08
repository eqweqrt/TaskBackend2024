<?php

namespace App\Action\User;

use App\DataTransferObject\User\RegistrationData;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistrationUserAction
{
    public static function execute(RegistrationData $data): array
    {
        $passwordHash = Hash::make($data->password);

        $user = new User([
            'name' => $data->name,
            'surname' => $data->surname,
            'patronymic' => $data->patronymic,
            'email' => $data->email,
            'password' => $passwordHash,
        ]);
        $user->save();
        $token = $user->createToken('token')->plainTextToken;
        return ['user' => $user, 'token' => $token];
    }
}
