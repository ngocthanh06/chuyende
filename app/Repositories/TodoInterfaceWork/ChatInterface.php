<?php

namespace App\Repositories\TodoInterfaceWork;

interface ChatInterface
{
    public function contacts();

    public function getMessagesFor($id);

    public function newMessage($request);
}