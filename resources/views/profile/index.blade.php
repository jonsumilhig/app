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
            @include('profile.profileInformation')
            <div class="py-8">
                <div class="border-top"></div>
            </div>
            <!--Update Password-->
            @include('profile.updatePassword')
            <div class="py-8">
                <div class="border-top"></div>
            </div>
            <!--Browser Session-->
            @include('profile.logoutBrowserSession')
            <div class="py-8">
                <div class="border-top"></div>
            </div>
            <!--Delete Account-->
            @include('profile.deleteAccount')
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
