<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class prepayment extends Model
{
    protected $table = 'prepayment';
    
    protected $primaryKey = 'pre_id'; 

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'user_id');
    }
}
