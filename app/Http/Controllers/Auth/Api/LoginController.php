<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use config\HttpCodeStatus;
use Illuminate\Http\JsonResponse;
use App\Models\User;

class LoginController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $credentials = $request->only('email', 'password');
            if (!auth()->attempt($credentials)) {
                return response()->json(['error' => 'Invalid Credentials'], HttpCodeStatus::HTTP_UNAUTHORIZED);
            }

            $token = auth()->user()->createToken('authToken');
            return response()->json([
                'data' => [
                    'token' => $token->accessToken->name,
                    'value' => $token->plainTextToken
                ]
            ], 201);
        } catch (\Exception $error) {
            return response()->json(
                ['Error to authenticate: ' => $error->getMessage()],
                HttpCodeStatus::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function logout(): JsonResponse
    {
        try {
            auth()->user()->tokens()->delete();
            return response()->json(['Message' => 'Success logout'], HttpCodeStatus::HTTP_NO_CONTENT);
        } catch (\Exception $error) {
            return response()->json(
                ['Error message: ' => $error->getMessage()],
                HttpCodeStatus::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
