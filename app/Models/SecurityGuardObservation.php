<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecurityGuardObservation extends Model
{
    use HasFactory;
    protected $fillable = ['location', 'observation', 'user_id'];
}
