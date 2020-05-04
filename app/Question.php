<?php

namespace App;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title','body'];
    public function user(){
      return $this->belongsTo('App\User');
    }

    public function answer(){
      return $this->hasMany('App\Answer');
    }

    public function setTitleAttribute($value){
      $this->attributes['title'] =$value;
      $this->attributes['slug'] = Str::slug($value);
    }

    public function getUrlAttribute(){
      return route('question.show',$this->slug);
    }

    public function getCreatedDateAttribute(){
      return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute(){
      if($this->answers >0){
        if($this->best_answere_id){
          return "answered-accepted";
        }
        return "answered";
      }
      return 'unanswered';
    }

    public function acceptBestAnswer(Answer $answer)
    {
        $this->best_answer_id = $answer->id;
        $this->save();
    }

    public function favorites(){
      return $this->belongsToMany('App\User','favorites')->withTimestamps();
    }

}
