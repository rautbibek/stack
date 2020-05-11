<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use VotableTrait;

    protected $fillable= ['body','user_id'];
    protected $appends = ['created_date','body_html','is_best'];
    public function question(){
        return $this->belongsTo('App\Question');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function getBestAttribute(){
        return $this->isBest() ? 'vote-accept':'';
    }
     
    public function getCreatedDateAttribute(){
      return $this->created_at->diffForHumans();
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

    public function getBodyHtmlattribute(){ 
      return $this->parseDown();
    }

    public function getExcerptAttribute(){
      return str_limit(strip_tags($this->parseDown()),250);
    }

    public function parseDown(){
      return clean($this->body);
    }


}
