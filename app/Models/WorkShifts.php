<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkShifts extends Model
{
    protected $table = 'workshifts';
    
    protected $primaryKey = 'work_id';

    public function formm(){
        return $this->belongsTo('\App\Models\FormM','form_id','form_id');
    }

    public function user() {
        return $this->belongsTo('\App\User','user_id','user_id');
    }
}
