<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Services\LogoutOtherBrowserSession;
use Illuminate\Http\Request;

class ProfileController extends Controller
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
     * Display a listing of the resource.
     *
     * @param LogoutOtherBrowserSession $logoutOtherBrowserSession
     * @return \Illuminate\Contracts\View\View
     */
    public function index(LogoutOtherBrowserSession $logoutOtherBrowserSession)
    {
        return view('profile.index', ['sessions' => $logoutOtherBrowserSession->getSessionsProperty()]);
    }
}
