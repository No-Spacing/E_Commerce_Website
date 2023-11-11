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

        $botman->hears('Hello', function($botman){
            $this->askName($botman);
        });

        $botman->hears('pain|paracetamol|pain relief|fever|pain relief and fever', function ($botman){
            $botman->reply('We have this product
            PARACETAMOL + IBUPROFEN PAIN RELIEF and
            PARACETAMOL + IBUPROFEN FAST RELAX');
        });

        $botman->hears('memory|brain|brain and memory|herbal|supplement|vitamins|protection|improvement|medicine|body|stress|wellness|strength|endurance|health|healths|natural', function ($botman){
            $botman->reply('We have this product
            CURAMED for Brain and Memory');
        });

        $botman->hears('immunity', function ($botman){
            $botman->reply('We have this product
            DriveMax Plus Capsule, DriveMax Coffee, Guard-C Capsule, and NutriCleanse Herbal Capsule');
        });

        $botman->hears('multivitamins|food|supplement|syrup|vitamins|taurine|lysine|chlorella|growth|fruity|immune|system', function ($botman){
            $botman->reply('We have this product
            YummVit 120ml');
        });

        $botman->hears('sexual|sexual health vitamins', function ($botman){
            $botman->reply('We have this product
            DriveMax Plus Capsule and DriveMax Coffee');
        });

        $botman->hears('drinks|coffee', function ($botman){
            $botman->reply('We have this product
            Maxan Mangosteen Coffee and DriveMax Coffee');
        });

        $botman->hears('digestion|digestive|cleanse', function ($botman){
            $botman->reply('We have this product
            NutriCleanse');
        });

        $botman->hears('tea|soya|drink|energy|wellness|caffeine|acidic|colds|health|esteem|strengthen', function ($botman){
            $botman->reply('We have this product
            Power Cells 6in1 Salabat');
        });

        $botman->hears('heart and blood pressure|blood pressure|heart', function ($botman){
            $botman->reply('We have this product
            Power Cells Herbal Capsule');
        });
        
        $botman->fallback(function($bot) {
            $bot->reply('Sorry, I did not understand these commands.Please type "help" for more commands.');
        });

        $botman->hears('help', function($botman){
                $botman->reply("Type the type of product that you are looking for ex.(immunity, heart, sexual, digestion, cough, colds, headache, dizziness, stomachaches, pains, vitamins, growth, oil, energy, performance, capsule and pains)");
        });

       

        // $botman->hears('{message}', function($botman, $message) {
  
        //     if ($message == "Hi") {
        //         $this->askName($botman);
        //     }else{
        //         $botman->reply('Command not found please type help for more info.');
        //     }
  
        // });
  
        $botman->listen();
    }

    public function askName($botman)
    {
        $botman->ask('Hello! What is your Name?', function(Answer $answer) {
  
            $name = $answer->getText();
  
            $this->say('Nice to meet you '.$name);
        });
    }

    // public function askLove($botman){
    //     $botman->ask('Do you Love me?', [
    //         [
    //             'pattern' => 'yes|yep',
    //             'callback' => function () {
    //                 $this->say('Awe! I love you too so much! <3 <3 <3');
    //             }
    //         ],
    //         [
    //             'pattern' => 'nah|no|nope',
    //             'callback' => function () {
    //                 $this->say("I knew you don't love me :< </3");
    //             }
    //         ]
    //     ]);
    // }
}
