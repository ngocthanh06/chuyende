<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\User;
use App\Models\PasswordReset;
use Illuminate\Support\Str;
use App\Mail\ResetPasswordMailtable;
class resetPasswordController extends Controller
{
    public function sendToken(Request $request){
        $user = User::where('email', $request->email)->first();
        
        if(!isset($user->User_id)){
            return response()->json(['error' => 'Email người dùng không tồn tại', 401]);
        }

        $token =  Str::random(32) ;

        Mail::to($user)->send(new ResetPasswordMailtable($token));

        $passwordReset = new PasswordReset();
        $passwordReset->email = $user->email;
        $passwordReset->token = $token;
        $passwordReset->save();
    }

    public function validateToken(Request $request){
        $passwordReset = PasswordReset::where('token', $request->token)->first();
        if(!isset($passwordReset->email))
        {
            return response()->json(['error' => 'Token không hợp lệ', 401]);
        }
        $user = User::where('email', $passwordReset->email)->first();
        return response()->json($user, 200);
    }

    public function resetPassword(Request $request){
        $user = User::find($request->user_id);
        // $passwordReset = PasswordReset::where('email', $user->email)->first();
        // $passwordReset->delete();
        PasswordReset::where('email', $user->email)->delete();
        $user->password = bcrypt($request->password);
        $user->save();

    }

}
