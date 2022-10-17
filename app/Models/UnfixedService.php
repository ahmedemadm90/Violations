<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnfixedService extends Model
{
    use HasFactory;
    protected $fillable = [
        "en_name", "ar_name", "en_job", "ar_job", "nid", "phone1", "phone2", "address", "gender",
        "active", 'company_id', 'permit_id', 'blacklist'
    ];

    public function company()
    {
        return $this->belongsTo(Service_Company::class, 'company_id');
    }
}
