<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Authenticatable
{
    use Notifiable;

    protected $guard = 'company';

    protected $table = 'companies';

    protected $fillable =['user_id', 'company_name',
        'company_description', 'extra_information', 'location'];

    protected $hidden = ['password', 'remember_token'];
}
