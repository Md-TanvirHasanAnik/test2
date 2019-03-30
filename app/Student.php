<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends User
{
    //
    protected $table = 'students';

    protected $fillable = [
        's_id','name', 'email','phone','department','photo','campus','level_term','password',
    ];
}
