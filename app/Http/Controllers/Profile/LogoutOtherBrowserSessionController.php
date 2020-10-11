<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ConfirmPassword;
use App\Services\LogoutOtherBrowserSession;

class LogoutOtherBrowserSessionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function destroy(User $user, ConfirmPassword $confirmPassword, LogoutOtherBrowserSession $logoutOtherBrowserSession)
    {
        if (!$confirmPassword->check('confirm_password_session')) {
            return $confirmPassword->confirm('confirm_password_session');
        }
        $logoutOtherBrowserSession->logoutOtherBrowserSessions('confirm_password_session');
        return back();
    }
}
