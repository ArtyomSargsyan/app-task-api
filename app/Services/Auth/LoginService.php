<?php
namespace App\Services\Auth;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    /**
     * @param string $email
     * @param string $password
     * @return JsonResponse
     */
    public function login(string $email , string $password): JsonResponse
    {
        try {
            if (!Auth::attempt(['email' => $email, 'password' => $password])) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password do not match our records.',
                ], 401);
            }

            $user = Auth::user();

            $token = $user->createToken('API Token')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'User logged in successfully',
                'token' => $token
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred: ' . $th->getMessage()
            ], 500);
        }
    }
}
