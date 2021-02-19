<?php

namespace App\Repositories\Work;
use App\Models\Company;
use App\User;
use App\Models\FormM;
use App\Models\WorkShifts;


class baseEloquent 
{
    protected $company;
    protected $user;
    protected $formm;
    protected $workShifts;

    public function __construct(Company $company, User $user, FormM $formm, WorkShifts $workShifts)
    {
        $this->company = $company;
        $this->user = $user;
        $this->formm = $formm;
        $this->workShifts = $workShifts;
    }
}
