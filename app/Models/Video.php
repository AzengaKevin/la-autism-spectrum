<?php

namespace App\Models;

use App\Models\Questionnaire;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['questionnaire_id', 'description', 'path'];

    /**
     * Video Questionnaire Relationship 1 : 1
     */
    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }

    /**
     * Deleting the video files to clean resources
     */
    public function deleteFileFromStorageIfNecessary()
    {
        if(Storage::disk('public')->exists($this->path)) 
            Storage::disk('public')->delete($this->path);
    }

    /**
     * Get URL of the video from storage
     * 
     * @return string the video URL
     */
    public function pathUrl() : string
    {
        return Storage::disk('public')->url($this->path);
    }
}
