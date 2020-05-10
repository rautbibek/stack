<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends =[
      'url','avatar'
    ];

    public function question(){
      return $this->hasMany('App\Question');
    }

    public function answer(){
      return $this->hasMany('App\Answer');
    }

    public function getUrlAttribute(){
      return "#";
    }

    public function getAvatarAttribute(){
        $email = $this->email;
        $size = 30;
        return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?s=" . $size;
    }

    public function favorites(){
      return $this->belongsToMany('App\Question','favorites')->withTimestamps();
    }

    public function voteQuestions(){ 
      return $this->morphedByMany('App\Question','votable');
    }

    public function voteAnswers(){
      return $this->morphedByMany('App\Answer','votable');
    }

    public function voteQuestion(Question $question,$vote){
      $voteQuestions = $this->voteQuestions();
      $this->_vote($voteQuestions,$question,$vote);
    }

    public function voteAnswer(Answer $answer,$vote){
      $voteAnswers = $this->voteAnswers();
      $this->_vote($voteAnswers,$answer,$vote);
    }

    private function _vote($relation , $model ,$vote){
      if($relation->where('votable_id',$model->id)->exists()){
        $relation->updateExistingPivot($model,['vote'=>$vote]);
      }else{
        $relation->attach($model, ['vote'=>$vote]);
      }
      //$question->load('voted');
      $downVotes = (int) $model->downVotes()->sum('vote');
      $upVotes = (int) $model->upVotes()->sum('vote');
      if($model->table =='questions'){
        $model->votes = $upVotes + $downVotes;
      }else{
        $model->votes_count = $upVotes + $downVotes;
      }
      
      $model->save();
    }

}
