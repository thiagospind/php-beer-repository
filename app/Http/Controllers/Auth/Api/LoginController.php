<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\StatusCodes\HttpStatusCode;
use config\HttpCodeStatus;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $credentials = $request->only('email', 'password');
            if (!auth()->attempt($credentials)) {
                return response()->json(['error' => 'Invalid Credentials'], HttpStatusCode::HTTP_UNAUTHORIZED);
            }

            $token = auth()->user()->createToken('authToken');
            return response()->json([
                'data' => [
                    'token' => $token->accessToken->name,
                    'value' => $token->plainTextToken
                ]
            ], HttpStatusCode::HTTP_CREATED);
        } catch (\Exception $error) {
            return response()->json(
                ['error' => 'Error to authenticate: '.$error->getMessage()],
                HttpStatusCode::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function logout(): JsonResponse
    {
        try {
            auth()->user()->tokens()->delete();
            return response()->json(['message' => 'Success logout'], HttpStatusCode::HTTP_NO_CONTENT);
        } catch (\Exception $error) {
            return response()->json(
                ['Error message: ' => $error->getMessage()],
                HttpStatusCode::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
