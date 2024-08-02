<?php
namespace App\Services\Auth;

use App\Repositories\RegisterRepository;
use Illuminate\Http\JsonResponse;

class RegisterService
{
    /**
     * @param RegisterRepository $registerRepository
     */
    public function __construct(RegisterRepository $registerRepository)
    {
        $this->registerRepository = $registerRepository;
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @return JsonResponse
     */
    public function register(string $name, string $email, string $password): JsonResponse
    {
        try {
            $user = $this->registerRepository->register($name, $email, $password);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
