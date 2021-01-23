<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use JWTAuth;
use App\Models\messages;
use App\Events\MessagesNew;
use App\Repositories\TodoInterfaceWork\ChatInterface;

class chatController extends Controller
{
    protected $chat;

    public function __construct(ChatInterface $chat)
    {
        $this->chat = $chat;
    }

    public function contacts()
    {   
        return response()->json($this->chat->contacts());
    }

    public function getMessagesFor($id)
    {
        return response()->json($this->chat->getMessagesFor($id));
    }

    public function newMessage(Request $request)
    {
        $request['to'] = auth()->user()->user_id;

        return response()->json($this->chat->newMessage($request));
    }


    public function sends()
    {
        $id = Auth::user()->user_id;
        $messages = 'THạnh';
        // $user = User::find($id);
        return $id;
        // broadcast(new MessagesNew($messages))->toOthers();
        event(new MessagesNew($messages, $user)); 
        // return response()->json($messages);
    }
}
