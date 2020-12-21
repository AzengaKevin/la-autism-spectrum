<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScreeningResponse extends Model
{
    use HasFactory;

    protected $fillable = ['screening_id', 'answer_id', 'question_id'];
}
