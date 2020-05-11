<?php

namespace App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use VotableTrait;
    protected $fillable = ['title','body'];
    protected $appends = ['created_date','favorite_count','is_favorite'];
    public function user(){
      return $this->belongsTo('App\User');
    }

    public function answer(){
      return $this->hasMany('App\Answer')->orderBy('votes_count','DESC');
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
        if($this->best_answer_id){
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

    public function getFavoriteCountAttribute(){
      return $this->favorites->count();
    }

    public function getIsFavoriteAttribute(){
      return $this->favorites()->where('user_id',Auth::id())->count() >0;
    }

    public function getHtmlBodyattribute(){ 
      return $this->parseDown();
    }

    public function getExcerptAttribute(){
      return str_limit(strip_tags($this->parseDown()),250);
    }

    public function parseDown(){
      return clean($this->body);
    }

}
