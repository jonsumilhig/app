<?php

namespace App\Http\Controllers\Profile;

use App\Actions\TwoFactorAuthentication\DisableTwoFactorAuthentication;
use App\Actions\TwoFactorAuthentication\EnableTwoFactorAuthentication;
use App\Actions\TwoFactorAuthentication\GenerateNewRecoveryCodes;
use App\Http\Controllers\Controller;
use App\Models\User;

class TwoFactorAuthenticationController extends Controller
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

    /**
     * @param User $user
     * @param EnableTwoFactorAuthentication $enable
     * @return \Illuminate\Http\RedirectResponse
     */
    public function enable(User $user, EnableTwoFactorAuthentication $enable)
    {
        $enable($user);
        return back();
    }

    /**
     * @param User $user
     * @param DisableTwoFactorAuthentication $disable
     * @return \Illuminate\Http\RedirectResponse
     */
    public function disable(User $user, DisableTwoFactorAuthentication $disable)
    {
        $disable($user);
        return back();
    }

    /**
     * @param User $user
     * @param GenerateNewRecoveryCodes $generate
     * @return \Illuminate\Http\RedirectResponse
     */
    public function regenerate(User $user, GenerateNewRecoveryCodes $generate)
    {
        $generate($user);
        return back();
    }
}
