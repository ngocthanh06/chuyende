<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormM extends Model
{
    protected $table = 'forms';
    
    protected $primaryKey = 'form_id';

    public function workshifts() {
        return $this->hasMany(WorkShifts::class, 'form_id', 'form_id');
    }
}
