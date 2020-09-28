<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'user_id';
    
    protected $fillable = [
        'birthday',
        'email',
        'socical_insurance',
        'password',
        'role_id',
        'user_add',
        'user_phone',
        'user_bank',
        'user_fullname',
        'user_image',
        'username',
        'sex',
        'idComp',
        'date_start',
        'date_end',
        'active'
    ];



}

