<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\StatusFormsEnum;

class FormM extends Model
{
    protected $table = 'forms';
    
    protected $primaryKey = 'form_id';

    protected $fillable = [
        'form_name',
        'form_work',
        'form_time_in',
        'form_time_out',
        'form_desc',
        'status'
    ];

    public function workshifts() 
    {
        return $this->hasMany(WorkShifts::class, 'form_id', 'form_id');
    }

    public function scopeStatusOpen($query)
    {
        return $query->where('status', StatusFormsEnum::OPEN);
    }

    public function scopeStatusClose($query)
    {
        return $query->where('status', StatusFormsEnum::CLOSE);
    }
}
