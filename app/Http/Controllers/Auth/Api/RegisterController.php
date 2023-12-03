<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    public function registerUser(UserRegisterRequest $request, User $user): JsonResponse
    {
        try {
            $request->validated();
            $userData = $request->only('name', 'email', 'password');
            $userData['password'] = bcrypt($userData['password']);
            $user = User::create($userData);

            return response()->json([
                'data' => [
                    'user' => $user
                ]
            ], 201);
        } catch (\Exception $error) {
            return response()->json('Error to create user: '.$error->getMessage(), 500);
        }
    }
}