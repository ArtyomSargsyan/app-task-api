<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\LogoutService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    protected LogoutService $logoutService;

    /**
     * @param LogoutService $logoutService
     */
    public function __construct(LogoutService $logoutService)
    {
        $this->logoutService = $logoutService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        return $this->logoutService->logout($request->user());

    }
}
