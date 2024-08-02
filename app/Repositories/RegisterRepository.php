<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterRepository
{
    public function register($name, $email, $password)
    {
      return User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);
    }
}
