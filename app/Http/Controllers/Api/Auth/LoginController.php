<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\Auth\LoginService;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{

    protected LoginService $loginService;

    /**
     * @param LoginService $loginService
     */
    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        return $this->loginService->login($request->email, $request->password);
    }

}
