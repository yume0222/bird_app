<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification; //Notificationモデルをインポート
use App\Models\User; //Userモデルをインポート
use Illuminate\Support\Facades\Auth; //Auth

class NotificationController extends Controller
{
   public function notification()
   {
       $notifications = auth()->user()->notifications()->orderBy('created_at', 'desc')->get();
       return view('posts.notification', compact('notifications'));
   }
   
   public function notificationUser(Notification $notification)
   {
      return view('posts.notification_show_user')->with(['notification' => $notification]);
   }


}
