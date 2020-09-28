<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $primaryKey = 'att_id';

    public function user(){
        return $this->belongsTo('App\User', 'user_accept',`user_id`);
    }

    public function workshifts()
    {
        return $this->belongsTo(WorkShifts::class, 'workshifts_id', 'work_id');
    }
}
