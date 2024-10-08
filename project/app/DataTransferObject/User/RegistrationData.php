<?php

namespace App\DataTransferObject\User;

use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\Password;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Data;

class RegistrationData extends Data
{
    public function __construct(
        #[Required, Max(255)]
        public readonly string      $name,
        #[Required, Max(255)]
        public readonly string      $surname,
        #[Nullable, Max(255)]
        public readonly null|string $patronymic,
        #[Required, Unique('users', 'email'), Email]
        public readonly string      $email,
        #[Required, Password(min: 6)]
        public readonly string      $password,
    ) {}

    public static function attributes(...$args): array
    {
        return [
            'name' => 'имя',
            'surname' => 'фамилия',
            'patronymic' => 'отчество',
            'email' => 'почта',
            'password' => 'пароль',
        ];
    }
}
