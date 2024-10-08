<?php

namespace App\Action\User;

class LogoutUserAction
{
    public static function execute(): void
    {
        auth()->user()->tokens()->delete();
    }
}
