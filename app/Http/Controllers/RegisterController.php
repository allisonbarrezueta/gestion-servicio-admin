<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = new User($request->except(['device_name', 'categories']));
        $user->password = Hash::make($request->input('password'));
        $user->save();

        $token = $user->createToken($request->device_name);

        if ($request->has('categories')) {
            $user->categories()->attach($request->input('categories'));
        }

        return [
            'full_name' => $user->full_name,
            'token' => $token->plainTextToken,
        ];
    }
}
