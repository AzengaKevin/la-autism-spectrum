<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Questionnaire extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['user_id', 'title', 'slug', 'description', 'age', 'type'];

    /**
     * Associating a questionnaire to its owner
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Questionnaire questions relationship where a questionnaire has many questions
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Questionnaire Screenings Relationship
     */
    public function screenings()
    {
        return $this->hasMany(Screening::class);
    }

    /**
     * Questionnaire picture Relationship 1 : M
     */
    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }

    /**
     * Questionnaire Video Relationship 1 : 1
     */
    public function video()
    {
        return $this->hasOne(Video::class);
    }

    /**
     * Data function containing the type of questionnaires
     * 
     * @return array of the types of questionnaires
     */
    public static function types() : array
    {
        return ['questions', 'pictures', 'video'];
    }
}
