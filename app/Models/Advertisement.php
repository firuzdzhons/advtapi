<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
        * Get the image links for the advertisement.
    */
    public function imageLinks()
    {
        return $this->hasMany(ImageLink::class);
    }
}
