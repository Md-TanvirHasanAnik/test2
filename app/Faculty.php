<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends User
{
    //
    protected $table = 'faculties';

    protected $fillable = [
        'f_id','name','designation', 'email','phone','department','faculty','photo','password',
    ];
}
