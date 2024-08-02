<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\Auth\RegisterService;
use Illuminate\Http\JsonResponse;


class RegisterController extends Controller
{
    /**
     * @param RegisterService $registerService
     */
    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
       return $this->registerService->register($request->name, $request->email, $request->password);
    }

}
