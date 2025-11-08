<?php

namespace App;

use App\Models\Client;

trait UssdLoggedInUser
{
    function getUserByPhone($phone): ?Client
    {
        return Client::query()->where('phone', $phone)->first();
    }

    function getUserByEmail($email): ?Client
    {
        return Client::query()->where('email', $email)->first();
    }
}
