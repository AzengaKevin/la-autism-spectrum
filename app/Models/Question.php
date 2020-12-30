<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['questionnaire_id', 'question'];

    /**
     * Question Questionnaire Relationship
     */
    public function questionnaire()
    {
        return $this->belongsToMany(Questionnaire::class);
    }

    /**
     * Question, Answer Relatonship
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

}
