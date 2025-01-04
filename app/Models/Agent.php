<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Authenticatable
{
    use HasFactory;

    Protected $fillable = [
        'agencyName',
        'agencyAddress',
        'agencyCity',
        'memName',
        'memNumber',
        'agentName',
        'agentminName',
        'agentlastName',
        'cnicNum',
        'cnicExp',
        'agentProfile',
        'agentCertificate',
        'cnicVerify',
        'agentEmail',
        'password',
    ];

    public function properties(){
        return $this->hasMany(Property::class);
    }

}


