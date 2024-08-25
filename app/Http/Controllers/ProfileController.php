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
    public function edit(Request $request, User $user, Prefecture $prefecture): View //プロフィール編集画面表示
    {
        $user = Auth::user();
        return view('profile.edit')->with(['user' => $user, 'prefectures' => $prefecture->get()]);
    }
    
    public function show(User $user) //プロフィール表示
    {
        $user = Auth::user();
        return view('profile.show')->with(['user' => $user]);
    }
    
    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse //プロフィール編集
    {
        if($request->file('image_path')){
            $image_url = Cloudinary::upload($request->file('image_path')->getRealPath())->getSecurePath();
            $request->user()->image_path = $image_url;
        }
    
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.show');
    }
    
    public function destroyProfilePicture(User $user) //プロフィール画像削除
    {
        $user = Auth::user();
        $user['image_path'] = null;
        $user->save();
        return redirect('/profile/show');
    }
    
    public function showUser(User $user) //各ユーザのプロフィール表示
    {
        return view('profile.show_user')->with(['user' => $user]);
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
