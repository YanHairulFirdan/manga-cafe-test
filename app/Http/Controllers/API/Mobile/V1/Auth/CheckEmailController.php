<?php

namespace App\Http\Controllers\API\Mobile\V1\Auth;

use App\Http\Controllers\Controller;
use App\Modules\Account\Models\Account;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CheckEmailController extends Controller
{
    public function check(Request $request)
    {
        $email = $request->input('email');

        $account = Account::query()->where('email', $email)->first();

        if (is_null($account)) {
            throw new NotFoundHttpException('NOT_FOUND');
        }

        return response()->json([]);
    }   
}
