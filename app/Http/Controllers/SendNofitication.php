<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use Illuminate\Http\Request;
use App\Notifications\TestNotification;
class SendNofitication extends Controller
{
    public function post(Request $request){
        return Auth::user();
        $user = User::find(1);
        $data = $request->only(['title', 'content']);
        return $data;
        $user->notify(new TestNotification($data));
        return 'thành côg';
    }
}
