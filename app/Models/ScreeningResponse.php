<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScreeningResponse extends Model
{
    use HasFactory;

    protected $fillable = ['screening_id', 'answer_id', 'question_id'];

    /** ScreeningResponse Question Realationship M : 1 */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    /** ScreeningResponse Answer Relationship M : 1 */
    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}
