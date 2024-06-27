<?php

namespace App\Http\Controllers\API\Mobile\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Mobile\V1\Auth\RegisterRequest;
use App\Modules\Account\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function store(RegisterRequest $request)
    {
        DB::beginTransaction();

        try {
            /** @var Account $account */
            $account = Account::query()->create($request->only(['email', 'password']));
            $token   = $account->createToken('auth-token')->plainTextToken;

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            throw $th;
        }

        return response()->json([
            'data' => [
                'access_token' => $token,
            ]
        ]);
    }
}
