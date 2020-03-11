<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';
    protected $primaryKey = 'idComp';
    protected $fillable = ['AddComp', 'emailComp', 'faxComp', 'nameComp', 'phoneComp'];

    public function users() {
        return $this->hasMany('App\User', 'idComp', 'idComp');
    }
}
