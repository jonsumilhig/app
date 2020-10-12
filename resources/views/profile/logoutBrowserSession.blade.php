<div class="row">
    <div class="col-md-4">
        <div class="px-4 px-sm-0">
            <h3 class="text-lg font-medium text-gray-900">Browser Sessions</h3>
            <p class="mt-1 text-sm text-gray-600">
                Manage and logout your active sessions on other browsers and devices.
            </p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-body">
                <p class="text-sm text-gray-600">If necessary, you may logout of all of your other browser sessions across all of your devices. If you feel your account has been compromised, you should also update your password.</p>
                @if (count($sessions) > 0)
                    <div class="mt-5 space-y-6">
                        <!-- Other Browser Sessions -->
                        @foreach ($sessions as $session)
                            <div class="d-flex align-items-center">
                                <div>
                                    @if ($session->agent->isDesktop())
                                        <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8 text-gray-500">
                                            <path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-gray-500">
                                            <path d="M0 0h24v24H0z" stroke="none"></path>
                                            <rect x="7" y="4" width="10" height="16" rx="1"></rect>
                                            <path d="M11 5h2M12 17v.01"></path>
                                        </svg>
                                    @endif
                                </div>

                                <div class="ml-3">
                                    <div class="text-sm text-gray-600">
                                        {{ $session->agent->platform() }} - {{ $session->agent->browser() }}
                                    </div>

                                    <div>
                                        <div class="text-xs text-gray-500">
                                            {{ $session->ip_address }},

                                            @if ($session->is_current_device)
                                                <span class="text-green-500 font-semibold">{{ __('This device') }}</span>
                                            @else
                                                {{ __('Last active') }} {{ $session->last_active }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                <div class="mt-5">
                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#mdlLogoutSession">Logout Other Browser Sessions</button>
                    <div class="modal fade" id="mdlLogoutSession" tabindex="-1" role="dialog" aria-labelledby="LogoutSessionLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="LogoutSessionLabel">Confirm Password</h5>
                                    <button type="button" class="close border-0" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('profile.destroy.logout.session', auth()->user()->uuid) }}" method="POST">
                                    <div class="modal-body">
                                        <p class="text-sm text-gray-600">Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.</p>
                                        @method('DELETE')
                                        @csrf
                                        <div class="form-group">
                                            <input type="password" name="confirm_password_session" id="confirm_password_session" class="form-control @error('confirm_password_session') is-invalid @enderror" autocomplete="current-password">
                                            @error('confirm_password_session')
                                            <span class="invalid-feedback" role="alert"><strong> {{ $message }} </strong></span>
                                            @enderror
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-dismiss="modal">Nevermind</button>
                                            <button type="submit" class="btn btn-danger">Delete Account</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
