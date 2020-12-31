<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function screeningVideos()
    {
        return $this->hasMany(ScreeningVideo::class);
    }
}
