<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScreeningVideo extends Model
{
    use HasFactory;

    protected $fillable = ['screening_id', 'picture_id', 'path'];

    /** ScreeningVideo Picture Relationship */
    public function picture()
    {
        return $this->belongsTo(Picture::class);
    }

    public function pathUrl() : string
    {
        return Storage::disk('public')->url($this->path);
    }
}
