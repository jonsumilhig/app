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
                    <button type="submit" class="btn btn-dark">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
