<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Employer extends Authenticatable
{
    protected $fillable = ['email', 'name', 'password'];
    protected $table = 'employers';
}
