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
