<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = '_attendance';
    protected $primaryKey = 'id_attendance';
    public $timestamps = false;
}
