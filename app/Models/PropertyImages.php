<?php

namespace App\Models;

use App\Models\Property;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyImages extends Model
{
    protected $fillable = ['property_id', 'file_path'];

    public function property(){
        return $this->belongsTo(Property::class);
    }
    use HasFactory;
}
