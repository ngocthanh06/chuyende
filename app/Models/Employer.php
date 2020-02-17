<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    //
    protected $table = 'users';
    protected $primaryKey = 'User_id';
    protected $fillable = ['Birthday','Password','Role_id','User_add','User_phone','User_bank','User_fullname','User_image','Username','sex','idComp'];
}

