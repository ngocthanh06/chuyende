<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $primaryKey = 'idComp';
    
    protected $fillable = [ 
        'add_comp', 
        'email_comp', 
        'fax_comp', 
        'nameComp', 
        'phone_comp'
    ];

    public function users() {
        return $this->hasMany('App\User', 'idComp', 'idComp');
    }
}
