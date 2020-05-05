<?php
use App\User;
use App\Answer;
use App\Question;
use Illuminate\Database\Seeder;

class VotableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('votables')->delete();
        $user = User::all();
        $user_count = $user->count();
        $votes = [1,-1];

        foreach(Question::all() as $question){
            for($i=0; $i< rand(1, $user_count); $i++){
                $users = $user[$i];
                $users->voteQuestion($question,$votes[rand(0,1)]);
            }
        }

        foreach(Answer::all() as $answer){
            for($i=0; $i< rand(1, $user_count); $i++){
                $users = $user[$i];
                $users->voteAnswer($answer,$votes[rand(0,1)]);
            }
        }
    }
}
