<?php
namespace App\Repositories\Work;

use App\Repositories\TodoInterfaceWork\ChatInterface;
use App\User;
use Auth;
use JWTAuth;
use App\Models\messages;
use App\Events\MessagesNew;
use Kreait\Firebase\Database;
use DB;

class ChatEloquent implements ChatInterface
{
    protected $messages;
    protected $user;
    protected $database;

    public function __construct(
        messages $messages,
        User $user,
        Database $database
    )
    {
        $this->messages = $messages;
        $this->user = $user;
        $this->database = $database;
    }

    public function contacts()
    {
        return $this->user->notUser()->get();
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
        DB::beginTransaction();

        try {
            $userFrom = 'chat/to_user_'. $request['to'] . '/chat/content';
    
            $newMessagesFirebase = $this->database->getReference($userFrom)
                ->push($request);
    
            $newMessageDB = $this->messages->create($request);

            DB::commit();
            
            return $newMessageDB;
        } catch (Exception $e) {
            DB::rollBack();
        
            throw new Exception($e->getMessage());
        }
    }
}

