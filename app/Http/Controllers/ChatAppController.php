<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ChatAppController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function listUser()
    {
        return $this->user::all();
    }
}
