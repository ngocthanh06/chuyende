<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Enums\RolesEnum;
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'user_id';

    protected $fillable = [ 
        'username', 'Phone' , 'idComp'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function workshifts()
    {
        return $this->hasMany('App\Models\WorkShifts', 'user_id', 'user_id');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'idComp', 'idComp');
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'role_id', 'role_id');
    }
    public function prepayment()
    {
        return $this->hasMany('App\Models\prepayment', 'user_id', 'user_id');
    }

    public function permission()
    {
        return $this->hasMany('App\Models\permission', 'user_id','user_id');
    }

    public function scopeEmployers($query) 
    {
        return $query->where('role_id', RolesEnum::EMPLOYER);
    }

    public function scopeNotUser($query)
    {
        return $query->where('user_id', '!=', auth()->user()->user_id);
    }
}
