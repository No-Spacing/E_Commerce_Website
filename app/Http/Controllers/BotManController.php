<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Conversations\Conversation;

class BotManController extends Controller
{
    
    public function handle()
    {
        $botman = app('botman');

        $botman->hears('hello|hi', function ($botman){
            $botman->ask('Hello! What is your Name?', function(Answer $answer) {
                $name = $answer->getText();
                $this->say('Nice to meet you '.$name);
            });
        });  
        $botman->listen();      

    }
    public function askName($botman)
    {
        $botman->ask('Hello! What is your Name?', function(Answer $answer) {
  
            $name = $answer->getText();
  
            $this->say('Nice to meet you '.$name);
        });
    }
    
}
