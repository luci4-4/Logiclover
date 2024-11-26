<?php

namespace App\Models;

use ILLuminate\Foundation\Auth\Cuser as Authenticatable;
use ILLuminate\Notifications\Notifiable;


class CUsers extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'id',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}
