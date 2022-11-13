<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dssdata extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "dssdata";
}
