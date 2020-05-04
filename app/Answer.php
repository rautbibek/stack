<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

    protected $fillable=['body','user_id'];

    public function question(){
        return $this->belongsTo('App\Question');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function getBestAttribute(){
        return $this->isBest() ? 'vote-accept':'';
    }

    public static function boot(){
        parent::boot();
        static::created(function($answer){
            $answer->question->increment('answers');
        });
       static::deleted(function($answer){
           // $answer->question->decrement('answers');
            $answer->question->decrement('answers');
        });
    }

    public function isBest(){
        return $this->id === $this->question->best_answer_id;
    }

    public function getIsBestAttribute(){
        return $this->isBest();
    }


}
