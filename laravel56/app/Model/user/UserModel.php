<?php

namespace App\model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     * 可大量分配的属性。
     * @var array
     */
    protected $fillable = [
        'name', 'account'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * 应该为数组隐藏的属性。
     * @var array
     */
    protected $hidden = [
        'password'
    ];
}
