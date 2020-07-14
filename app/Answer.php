<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['body','user_id'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::created(function ($answer){
            $answer->question->increment('answers_counts');
        });

        static::deleted(function ($answer){
            $question = $answer->question;
            $question->decrement('answers_counts');

            if ($question->best_answer_id == $answer->id) {
                $question->best_answer_id = NULL;
                $question->save();
            }

        });
    }
    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute()
    {
        return $this->id == $this->question->best_answer_id ? 'vote-accepted' : '';
    }
}
