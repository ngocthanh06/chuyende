<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\ChatApp;
use Carbon\Carbon;
use App\Enums\SeenEnum;
use Kreait\Firebase\Database;

class ChatAppController extends Controller
{
    protected $user;

    protected $chat;

    protected $database;

    public function __construct(User $user, ChatApp $chat, Database $database)
    {
        $this->database = $database;
        $this->chat = $chat;
        $this->user = $user;
    }

    public function listUser()
    {
        return $this->user::where('user_id', '!=', auth()->user()->user_id)->get();
    }

    public function sendMessage(Request $request)
    {
        $request['date_send'] = Carbon::now('Asia/Ho_Chi_Minh');
        $request['seen'] = SeenEnum::NOTSEEN;
        // $this->chat->create($request->all());
        $this->database->getReference('message')->push($request->all());

        return response()->json([
            'code' => 200,
            'status' => true
        ]);
    }
}
