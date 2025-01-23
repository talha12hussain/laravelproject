<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyNewForm extends Model
{
    use HasFactory;

    protected $table = 'property_new_forms';

    protected $fillable = [
        'type',
        'property_type',
        'city',
        'property_types',
        'address',
        'nearest_landmark',
        'floor',
        'bedrooms',
        'bathrooms',
        'property_size',
        'asking_price',
        'corner_property',
        'images',
        'contact_no',
        'agent_name',
        'description',
        'latitude',
        'longitude',
       
    ];

    protected $casts = [
        'images' => 'array',
    ];
}
