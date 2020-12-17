<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Questionnaire extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['user_id', 'title', 'slug', 'description', 'min_age'];

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
}
