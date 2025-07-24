<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'level',
        'question_text',
        'option_r', 'option_i', 'option_a', 'option_s', 'option_e', 'option_c',
        'question_order',
    ];
}
