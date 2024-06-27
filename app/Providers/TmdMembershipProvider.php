<?php

namespace App\Providers;

use Timedoor\TmdMembership\TmdMembershipProvider as ServiceProvider;

class TmdMembershipProvider extends ServiceProvider
{
    protected function initFcm()
    {
        // implement after aws sns ready

        // if ($auth->check()) {
        //     $user            = $auth->user();
        //     $currentToken    = $user->currentAccessToken()->token;
        //     $currentFcmToken = $user->fcmToken()->where('token_id', $currentToken)->first();

        //     $user->withFcmToken($currentFcmToken);
        // }
    }
}
