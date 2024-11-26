<?php

namespace App\Services;

use App\Models\MailUser; 

class MailUserService
{
    public function isEmailExists(string $email): bool
    {
        return MailUser::where('email', $email)->exists();
    }

    public function registerUser(string $email): MailUser
    {
        return MailUser::create(['email' => $email]);
    }
}
