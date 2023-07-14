<?php

namespace App\Traits;

use App\Models\User;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

trait AuthenticateUser
{

    protected function register($request)
    {

       return  User::create([
            //insert record in DB
            'first_name' => $request->first_name,
            'last_name' => $request->first_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'status' => User::STATUS_ACTIVE
        ])->assignRole($request->user_role);

    }


}