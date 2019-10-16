<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empoyee extends Model
{
    protected $table = '_employee';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
