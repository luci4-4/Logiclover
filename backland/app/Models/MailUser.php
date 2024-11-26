<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailUser extends Model
{
    use HasFactory;

    protected $table = 'mail_users';


    protected $fillable = [
        'email'
    ];
}
