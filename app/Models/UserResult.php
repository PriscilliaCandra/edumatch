<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'score_realistic', 'score_investigative', 'score_artistic',
        'score_social', 'score_enterprising', 'score_conventional',
        'personality_type', 'recommended_majors',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
