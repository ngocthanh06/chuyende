<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormM extends Model
{
    protected $table = 'formm';
    protected $primaryKey = 'FormM_id';

    public function workshifts() {
        return $this->hasMany('App\Models\Workshifts', 'FormM_id', 'FormM_id');
    }
}
