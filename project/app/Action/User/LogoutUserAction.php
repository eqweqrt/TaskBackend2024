<?php

namespace project\app\Action\User;

class LogoutUserAction
{
    public static function execute(): void
    {
        auth()->user()->tokens()->delete();
    }
}
