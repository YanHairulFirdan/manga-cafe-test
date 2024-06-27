<?php

namespace App\Http\Controllers\API\Mobile\V1\Auth;

use App\Modules\Otp\Models\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Mobile\V1\Otp\OtpRequest;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;

class OtpController extends Controller
{
    public function request(OtpRequest $request)
    {
        DB::beginTransaction();
        try {
            $otp = (new Otp)->getInstance($request);
            $otp->email = $request->email;
            $otp->save();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();

            return $e->getMessage();
        }

        Mail::to($otp->email)->queue(new OtpMail($otp));

        return response()->json([
            'data' => [
                'count_sending' => $otp->count_sending,
            ],
        ]);
    }

    public function check(Request $request)
    {
        $otp = new Otp();

        $request->validate([
            'email'    => 'required|email',
            'otp_code' => 'numeric|digits:' . $otp::DIGIT_OTP
        ]);

        try {
           $otp = $otp->checkOtp($request);
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([
            'data' => [
                'otp_id' => $otp->id,
            ]
        ]);
    }
}
