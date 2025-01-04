<?php

namespace App\Models;

use App\Models\Agent;
use App\Models\Floor;
use App\Models\PropertyImages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $table = 'properties';

    protected $fillable = [
        'name',
        'address',
        'plotSize',
        'dimFront',
        'dimWidth',
        'totalSize',
        'leasedArea',
        'nearestLand',
        'corner',
        'plot_type',
        'size_type',
        'parkingcap',
        'demandSqft',
        'absValue',
        'agent_id',
        'agentname',
        'agentcontact',
        'agentdetail',
        'contactPerson',
        
    ];

    public function floors()
    {
        
        return $this->hasMany(Floor::class);
    }

    public function images(){
    return $this->hasMany(PropertyImages::class);
    }

    public function agent(){
        return $this->belongsTo(Agent::class);
    }
}

