<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getShortDescriptionAttribute()
    {
        // if description is longer than 100 characters, cut it and add '...' at the end
        return strlen($this->description) > 100 ? substr($this->description, 0, 100).'...' : $this->description;
    }
}
