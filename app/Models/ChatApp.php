<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatApp extends Model
{
    protected $table = 'chat-app';

    protected $fillable = [
        'from',
        'to',
        'text',
        'date_send',
        'message',
        'seen'
    ];
}
