<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends User
{
    //

    //
    protected $table = 'admins';

    protected $fillable = [
        'a_id','name', 'email','phone','designation','photo','password',
    ];
}
