<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageLink extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    /**
        * Get the advertisement that owns the image.
    */
    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class);
    }
}
