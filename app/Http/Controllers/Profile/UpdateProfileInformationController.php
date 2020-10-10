<?php

namespace App\Http\Controllers\Profile;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UpdateProfileInformationController extends Controller
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
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @param ImageHelper $imageHelper
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user, ImageHelper $imageHelper)
    {
        $request->validate([
            'photo' =>  'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,'. auth()->user()->id .',id'
        ]);
        if ($request->file('photo')) {
            Storage::disk('public')->delete($user->profile_photo_path);
            $user->update(['profile_photo_path' => $imageHelper->storeProfilePhoto($request->file('photo'))]);
        }
        $user->update($request->only('name', 'email'));
        return redirect()->route('profile.index')->with('success', 'Your information has been updated successfully');
    }

    /**
     * Delete user's profile photo.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteProfilePhoto(User $user)
    {
        $user->deleteProfilePhoto();
        return redirect()->route('profile.index')->with('success', 'Your profile photo has been removed successfully');
    }
}
