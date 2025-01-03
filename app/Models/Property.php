<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'city', 'address', 'nearest_landmarks', 'corner', 'size', 
        'asking_price', 'description', 'image_path', 'contact_number', 'agent_name'
    ];
}
