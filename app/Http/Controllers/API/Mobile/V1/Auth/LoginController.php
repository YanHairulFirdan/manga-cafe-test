<?php

namespace App\Http\Controllers\API\Mobile\V1\Auth;

use App\Http\Requests\API\Mobile\V1\Auth\LoginRequest;

class LoginController
{
    public function login(LoginRequest $request)
    {
        /** @var \App\Modules\Account\Models\Account $user */
        $user = $request->authenticate();

        return response()->json([
            'data' => [
                'access_token' => $user->createToken($user->id)->plainTextToken,
            ]
        ]);
    }

    public function logout()
    {
        /** @var \App\Modules\Account\Models\Account $user */
        $user = auth()->user();
        $user->currentAccessToken()->delete();

        return response()->json();
    }
}
