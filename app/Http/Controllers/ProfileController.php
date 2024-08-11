<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User; //Userモデルをインポート
use App\Models\Prefecture; //Prefectureモデルをインポート
use App\Models\BirdPicture; //BirdPictureモデルをインポート
use Cloudinary; //画像

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    // public function edit(Request $request): View
    // {
    //     return view('profile.edit', [
    //         'user' => $request->user(),
    //     ]);
    // }
    public function edit(Request $request, Prefecture $prefecture, User $user): View
    {
        // if($request->file('bird_img_path')){
        //     $bird_img_path = Cloudinary::upload($request->file('bird_img_path')->getRealPath())->getSecurePath();
        //     $input += ['bird_img_path' => $bird_img_path];
        // }
        // if($request->file('image_path')){
        //     $image_pathl = Cloudinary::upload($request->file('image_path')->getRealPath())->getSecurePath();
        //     $input += ['image_pathl' => $image_path];
        // }
        $files = ['bird_img_path', 'image_path'];
            foreach ($files as $file) {
                if ($request->file($file)) {
                    $uploadedPath = Cloudinary::upload($request->file($file)->getRealPath())->getSecurePath();
                    $input[$file] = $uploadedPath;
                }
            }
                
        return view('profile.edit', [
            'user' => $request->user(),
            'prefectures' => $prefecture,
            'ages' => $user
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    
}
