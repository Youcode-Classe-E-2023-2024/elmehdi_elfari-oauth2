<?php

namespace App\Models;

use Laravel\Passport\Token as PassportToken;

class OAuthAccessToken extends PassportToken
{
    protected $table = 'oauth_access_tokens';
}
