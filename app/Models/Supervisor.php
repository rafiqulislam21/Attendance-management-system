<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
   protected $table = '_supervisor';
    protected $primaryKey = 'id_supervisor';
    public $timestamps = false;
}
