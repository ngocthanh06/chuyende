<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendance';
    protected $primaryKey = 'Att_id';

    public function user(){
        return $this->belongsTo('App\User', 'User_accept',`User_id`);
    }
}
