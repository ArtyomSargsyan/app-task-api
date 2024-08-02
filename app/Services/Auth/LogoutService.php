<?php
namespace App\Services\Auth;


use Illuminate\Http\JsonResponse;

class LogoutService
{
    /**
     * @param $user
     * @return JsonResponse
     */
    public function logout($user): JsonResponse
    {
        try {
            $user->currentAccessToken()->delete();

            return response()->json([
                'status' => true,
                'message' => 'Logged out successfully'
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred: ' . $th->getMessage()
            ], 500);
        }
    }
}
