<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkShifts extends Model
{
    protected $table = 'workshifts';
    protected $primaryKey = 'Work_id';

    public function FormM(){
        return $this->belongsTo(FormM::class,'FormM_id','FormM_id');
    }

    public function user() {
        return $this->belongsTo('\App\User','User_id','User_id');
    }
}