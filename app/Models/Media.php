<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $dates = [
        'created_at',
        'updated_at',
        'taken_at',
        'published_at'
    ];

    public function getTagsAttribute($value)
    {
        if(is_null($value))
        {
            return [];
        }
        else
        {
            return explode(' ', $value);
        }
    }
}
