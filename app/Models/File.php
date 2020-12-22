<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['path'];

    /**
     * A relationship with any interested model
     */
    public function fileable()
    {
        return $this->morphTo();
    }
}
