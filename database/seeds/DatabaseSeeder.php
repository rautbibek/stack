<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
          userQuestionAnswerTableSeeder::class,
          FavouritTableSeeder::class
          VotableTableSeeder::class
          ]);
        // factory(App\User::class,5)->create()->each(function($q){
        //   $q->question()
        //     ->saveMany(
        //       factory(App\Question::class,rand(1,8))->make()
        //   )->each(function ($q){
        //     $q->answer()->saveMany(factory(App\Answer::class,rand(1,5))->make()
        //   );
        //   });
        // });
    }
}
