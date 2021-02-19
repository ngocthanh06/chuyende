<?php

namespace App\Repositories\Work;
use App\Models\Company;
use App\User;

class baseEloquent 
{
    protected $company;
    protected $user;

    public function __construct(Company $company, User $user)
    {
        $this->company = $company;
        $this->user = $user;
    }
}
