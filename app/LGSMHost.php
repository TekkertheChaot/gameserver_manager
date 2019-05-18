<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LGSMHost extends Model
{
    protected $table = 'lgsm_hosts';
    public $timestamps = false;
    protected $primaryKey = 'host_id';
}
