<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServerCredentials extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'credential_id';
}
