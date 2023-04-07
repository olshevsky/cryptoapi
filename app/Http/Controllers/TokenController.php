<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class TokenController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return view('tokens', [
            'token' => null
        ]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function createToken(Request $request): View
    {
        $tokenLifetime = intval(config('sanctum.apiKeyExpiration'));
        $expiresAt = new \DateTime();
        $expiresAt->modify("+$tokenLifetime minutes");
        $token = $request->user()->createToken('api_token', ['rates:get'], $expiresAt);

        return view('tokens', [
            'token' => $token->plainTextToken
        ]);
    }
}
