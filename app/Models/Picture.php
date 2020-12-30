<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Picture extends Model
{
    use HasFactory;

    protected $fillable = ['questionnaire_id', 'alt', 'path', 'thumbnail'];

    /**
     * Picture Questionnaire Relationship M : 1
     */
    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }

    public function pathUrl() : string
    {
        return Storage::disk('public')->url($this->path);
    }

    public function thumbnailUrl()
    {
        return Storage::disk('public')->url($this->thumbnail);
    }
}
