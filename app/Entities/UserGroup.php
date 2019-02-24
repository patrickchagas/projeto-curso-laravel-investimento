<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    
    use Notifiable;

    public $timestamps = true;
    protected $table = 'user_groups';
    protected $fillable = ['user_id', 'group_id'];
    protected $hidden = [];

}
