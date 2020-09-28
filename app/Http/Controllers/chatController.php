<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use JWTAuth;
use App\Models\messages;
use App\Events\MessagesNew;

class chatController extends Controller
{
    public function get(){
        $user = User::where('user_id', '!=', auth()->user()->user_id)->get();
        return response()->json($user);
    }

    public function getMessagesFor($id){
        $messages = messages::where('from', $id)->orWhere('to', $id)->get();
        return response()->json($messages);
    }

    // public function send(Request $request){
    //     $messages = messages::create([
    //         'from' => auth()->user()->user_id,
    //         'to' => $request->contact_id,
    //         'text' => $request->text
    //     ]);
        
    //     $user = User::find(auth()->user()->user_id);
    //     // broadcast(new MessagesNew($messages))->toOthers();
    //     event(new MessagesNew($messages, $user));

    //     return response()->json($messages);
    // }

    public function sends(){
        $id = Auth::user()->user_id;
        $messages = 'THạnh';
        // $user = User::find($id);
        return $id;
        // broadcast(new MessagesNew($messages))->toOthers();
        event(new MessagesNew($messages, $user)); 
        // return response()->json($messages);
    }
}
