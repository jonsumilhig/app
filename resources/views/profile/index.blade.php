@extends('layouts.app')

@section('content')
<div class="container-xxl">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if (session('success'))
                <div class="alert alert-success my-5" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <!--Profile Information-->
            <div class="row">
                <div class="col-md-4">
                    <div class="px-4 px-sm-0">
                        <h3 class="text-lg font-medium text-gray-900">Profile Information</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            Update your account's profile information and email address.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <form id="frmInformation" action="{{ route('profile.update.information', auth()->user()->uuid) }}" method="POST" enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf
                                <div class="text-center">
                                    <div class="mt-2">
                                        <img class="block rounded-circle w-24 h-24 bg-cover bg-no-repeat bg-center" id="photoPreview" src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}">
                                    </div>
                                    <div class="my-2">
                                        <label class="btn btn-light mt-2">
                                            <span>Select a New Photo</span>
                                            <input type="file" name="photo" style="display: none" onchange="document.getElementById('photoPreview').src = window.URL.createObjectURL(this.files[0])">
                                        </label>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? auth()->user()->name }}" autocomplete="name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert"><strong> {{ $message }} </strong></span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') ?? auth()->user()->email }}" autocomplete="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert"><strong> {{ $message }} </strong></span>
                                    @enderror
                                </div>
                            </form>
                        </div>
                        <div class="card-footer bg-white text-right">
                            @if (auth()->user()->profile_photo_path)
                                <form id="frmPhoto" action="{{ route('profile.update.photo', auth()->user()->uuid) }}" method="POST" class="d-none">
                                    @method('PATCH')
                                    @csrf
                                </form>
                                <button type="submit" form="frmPhoto" class="btn btn-light">Remove Photo</button>
                            @endif
                            <button type="submit" form="frmInformation" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-8">
                <div class="border-top"></div>
            </div>
            <!--Update Password-->
            <div class="row">
                <div class="col-md-4">
                    <div class="px-4 px-sm-0">
                        <h3 class="text-lg font-medium text-gray-900">Update Password</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            Ensure your account is using a long, random password to stay secure.
                        </p>
                        <p class="mt-1 text-sm text-gray-600">
                            After changing password, you must log back in.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow">
                        <form action="{{ route('profile.update.password', auth()->user()->uuid) }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="current_password">Current Password</label>
                                    <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror" value="{{ old('current_password') }}" autocomplete="current-password">
                                    @error('current_password')
                                    <span class="invalid-feedback" role="alert"><strong> {{ $message }} </strong></span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert"><strong> {{ $message }} </strong></span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}" autocomplete="new-password">
                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert"><strong> {{ $message }} </strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer bg-white text-right">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="py-8">
                <div class="border-top"></div>
            </div>
            <!--Two Factor Authentication-->
            <div class="row">
                <div class="col-md-4">
                    <div class="px-4 px-sm-0">
                        <h3 class="text-lg font-medium text-gray-900">Two Factor Authentication</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            Add additional security to your account using two factor authentication.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <h3 class="text-lg font-medium text-gray-900">
                                @if ($enableTwoFactorAuthentication)
                                    {{ __('You have enabled two factor authentication.') }}
                                @else
                                    {{ __('You have not enabled two factor authentication.') }}
                                @endif
                            </h3>

                            <div class="mt-3 text-sm text-gray-600">
                                <p>
                                    When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone's Google Authenticator application.
                                </p>
                            </div>
                            @if ($enableTwoFactorAuthentication)

                                <div class="mt-4 text-sm text-gray-600">
                                    <p class="font-semibold">
                                        {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application.') }}
                                    </p>
                                </div>

                                <div class="mt-4">
                                    {!! auth()->user()->twoFactorQrCodeSvg() !!}
                                </div>

                                <div class="mt-4 text-sm text-gray-600">
                                    <p class="font-semibold">
                                        {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
                                    </p>
                                </div>

                                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 text-sm bg-gray-100 rounded-lg">
                                    @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes), true) as $code)
                                        <div>{{ $code }}</div>
                                    @endforeach
                                </div>
                            @endif
                            <div class="mt-5 space-x-1 space-y-1">
                                @if (!$enableTwoFactorAuthentication)
                                    <form action="{{ route('profile.enable.twoFactorAuthentication', auth()->user()->uuid) }}" method="post">
                                        @method('patch')
                                        @csrf
                                        <button type="submit" class="btn btn-dark">Enable</button>
                                    </form>
                                @else
                                    <div class="d-flex space-x-1">
                                        <form action="{{ route('profile.regenerate.twoFactorAuthentication', auth()->user()->uuid) }}" method="post">
                                            @method('patch')
                                            @csrf
                                            <button type="submit" class="btn btn-light">Regenerate Recovery Codes</button>
                                        </form>
                                        <form action="{{ route('profile.disable.twoFactorAuthentication', auth()->user()->uuid) }}" method="post">
                                            @method('patch')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Disable</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-8">
                <div class="border-top"></div>
            </div>
            <!--Browser Session-->
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
            <div class="py-8">
                <div class="border-top"></div>
            </div>
            <!--Delete Account-->
            <div class="row">
                <div class="col-md-4">
                    <div class="px-4 px-sm-0">
                        <h3 class="text-lg font-medium text-gray-900">Delete Account</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            Permanently delete your account.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <p class="text-sm text-gray-600">Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</p>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#mdlDeleteAccount">
                                Delete account
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="mdlDeleteAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirm Password</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="text-sm text-gray-600">Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.</p>
                            <form id="deleteAccount" action="{{ route('profile.destroy', auth()->user()->uuid) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <div class="form-group">
                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" autocomplete="current-password">
                                    @error('confirm_password')
                                    <span class="invalid-feedback" role="alert"><strong> {{ $message }} </strong></span>
                                    @enderror
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Nevermind</button>
                            <button type="submit" form="deleteAccount" class="btn btn-danger">Delete Account</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script type="application/javascript">
        $(document).ready(function () {
            @error('confirm_password_session') $('#mdlLogoutSession').modal('show'); @enderror
            @error('confirm_password') $('#mdlDeleteAccount').modal('show'); @enderror
        })
    </script>
@endpush
