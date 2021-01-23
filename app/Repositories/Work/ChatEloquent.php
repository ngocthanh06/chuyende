<?php
namespace App\Repositories\Work;

use App\Repositories\TodoInterfaceWork\ChatInterface;
use App\User;
use Auth;
use JWTAuth;
use App\Models\messages;
use App\Events\MessagesNew;

class ChatEloquent implements ChatInterface
{
    protected $messages;
    protected $user;

    public function __construct(
        messages $messages,
        User $user
    )
    {
        $this->messages = $messages;
        $this->user = $user;
    }

    public function contacts()
    {
        return $this->user->notUser()->employers()->get();
    }

    public function getMessagesFor($id)
    {
        return $this->messages
            ->where(function($query) use ($id) {
                $query->where('to', auth()->user()->user_id)
                    ->where('from', $id);
            })
            ->orWhere(function($query) use ($id) {
                $query->where('to', $id)
                    ->where('from', auth()->user()->user_id);
            })
            ->get();
    }

    public function newMessage($request)
    {
        return $this->messages->create($request->toArray());
    }
}

