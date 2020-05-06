<?php
namespace App;

trait VotableTrait{
    public function voted(){
      return $this->morphToMany('App\User','votable');
    }

    public function upVotes(){
      return $this->voted()->wherePivot('vote',1);
    } 

    public function downVotes(){
      return $this->voted()->wherePivot('vote',-1);
    }
}