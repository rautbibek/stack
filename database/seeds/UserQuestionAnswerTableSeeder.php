<?php

use Illuminate\Database\Seeder;

class UserQuestionAnswerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();
        \DB::table('answers')->delete();
        \DB::table('questions')->delete();
        factory(App\User::class,5)->create()->each(function($q){
           $q->question()
             ->saveMany(
               factory(App\Question::class,rand(1,8))->make()
           )->each(function ($q){
             $q->answer()->saveMany(factory(App\Answer::class,rand(1,5))->make()
           );
         });
        });
    }
}
