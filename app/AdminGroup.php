<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminGroup extends Model
{
    //
    public $timestamps = false;
    protected $table = 'groups';
    protected $primaryKey = 'group_id';
}
