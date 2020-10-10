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
                           <div class="text-center">
                               <div class="mt-2">
                                   <img class="block rounded-circle w-24 h-24 bg-cover bg-no-repeat bg-center" id="photoPreview" src="{{ auth()->user()->profile_photo_url }}" alt="">
                               </div>
                               <div class="my-2">
                                   <label class="btn btn-light mt-2">
                                       <span>Select a New Photo</span>
                                       <input type="file" style="display: none">
                                   </label>
                                   <button class="btn btn-dark">Remove Photo</button>
                               </div>
                           </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" autocomplete="name">
                                @error('name')
                                <span class="invalid-feedback" role="alert"><strong> {{ $message }} </strong></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ auth()->user()->email }}" autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert"><strong> {{ $message }} </strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer bg-white text-right">
                            <button class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-8">
                <div class="border-top"></div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="px-4 px-sm-0">
                        <h3 class="text-lg font-medium text-gray-900">Update Password</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            Ensure your account is using a long, random password to stay secure.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow">
                        <form action="{{ route('profile.update', auth()->id()) }}" method="POST">
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
                                            <form id="deleteAccount" action="{{ route('profile.destroy', auth()->id()) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <div class="form-group">
                                                    <input type="password" name="password" id="password" class="form-control @error('confirm-password') is-invalid @enderror" autocomplete="current-password">
                                                    @error('confirm-password')
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
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script type="application/javascript">
        $(document).ready(function () {
            @error('confirm-password') $('#mdlDeleteAccount').modal('show'); @enderror
        })
    </script>
@endpush
