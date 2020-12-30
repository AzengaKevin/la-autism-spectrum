<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
