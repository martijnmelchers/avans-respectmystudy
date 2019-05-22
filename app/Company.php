<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Authenticatable
{
    use Notifiable;

    protected $table = 'companies';

    protected $fillable =['email', 'password', 'role_id', 'company_name',
        'company_description', 'extra_information'];
    protected $hidden = ['password'];
}
