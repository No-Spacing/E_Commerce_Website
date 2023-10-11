<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;

class BotManController extends Controller
{
    public function handle()
    {
        $botman = app('botman');

        $botman->hears('Hello', function ($botman){
            $this->askName($botman);
        });

        $botman->hears('I love you', function ($botman){
            $this->askLove($botman);
        });

      
        // $botman->hears('{message}', function($botman, $message) {
  
        //     if ($message == "Hi") {
        //         $this->askName($botman);
        //     }else if($message == "Love"){
        //         $this->askLove($botman);
        //     }
  
        // });
  
        $botman->listen();
    }
  
    /**
     * Place your BotMan logic here.
     */
    public function askName($botman)
    {
        $botman->ask('Hello! What is your Name?', function(Answer $answer) {
  
            $name = $answer->getText();
  
            $this->say('Nice to meet you '.$name);
        });
    }

    public function askLove($botman){
        $botman->ask('Do you Love me?', [
            [
                'pattern' => 'yes|yep',
                'callback' => function () {
                    $this->say('Awe! I love you too so much! <3 <3 <3');
                }
            ],
            [
                'pattern' => 'nah|no|nope',
                'callback' => function () {
                    $this->say("I knew you don't love me :< </3");
                }
            ]
        ]);
    }
}
