<?php

namespace App\Http\Controllers;

use App\User;
use Mail;
use Illuminate\Support\Str;
use App\Mail\SendmailPermission;
use Illuminate\Http\Request;

class SendMailController extends Controller
{
    public function SendTokenPermission(Request $request)
    {
        $user = User::where('email', 'kunh0zdn@gmail.com')->first();

        if (!isset($user->user_id)) {
            return response()->json([
                'error' => 'Email người dùng không tồn tại', 401]
            );
        }
        
        Mail::to($user)->send(new SendmailPermission($request->month));
    }
}
