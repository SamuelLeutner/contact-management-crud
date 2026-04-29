<?php

namespace App\Actions;

use Illuminate\Support\Facades\Auth;

class LoginAction
{
  public function execute(array $credentials): bool
  {
    return Auth::attempt([
      'email'    => data_get($credentials, 'email'),
      'password' => data_get($credentials, 'password'),
    ], remember: false);
  }
}
