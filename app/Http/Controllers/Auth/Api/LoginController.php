<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use App\Models\User;

class LoginController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        try {

            $credentials = $request->only('email', 'password');
            if (!auth()->attempt($credentials)) {
                return response()->json(['error' => 'Invalid Credentials'], 401);
            }

            $token = auth()->user()->createToken('authToken');
            return response()->json([
                'data' => [
                    'token' => $token->accessToken->name,
                    'value' => $token->plainTextToken
                ]
            ], 201);
        } catch (\Exception $error) {
            return response()->json(['Error to authenticate: ' => $error->getMessage()], 500);
        }
    }

    public function logout(): JsonResponse
    {
        try {
            auth()->user()->tokens()->delete();
            return response()->json(['Message' => 'Success logout'], 204);
        } catch (\Exception $error) {
            return response()->json(['Error message: ' => $error->getMessage()], 500);
        }
    }

    public function token(User $user): JsonResponse
    {
//        $token = $user->currentAccessToken();
        $token = auth()->user();
        return response()->json(['token' => $token], 200);
    }
}
