<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Group extends Model
{
    public $timestamps = false;
    protected $table = 'user_group';
    protected $primaryKey = 'user_group_id';
}
