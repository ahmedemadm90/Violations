<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;
    protected $fillable = ['truck_no', 'driver_name', 'driver_id', 'company', 'carage', 'user_id', 'time_out'];
}
