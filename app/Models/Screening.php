<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Screening extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'email', 'path', 'questionnaire_id'];

    /**
     * Screening Response Relationship
     */
    public function responses()
    {
        return $this->hasMany(ScreeningResponse::class);
    }

    /**
     * Screening Questionnaire Relationship M : 1
     */
    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }

    public function screeningVideos()
    {
        return $this->hasMany(ScreeningVideo::class);
    }

    public function pathUrl() : string
    {
        return Storage::disk('public')->url($this->path);
    }
}
