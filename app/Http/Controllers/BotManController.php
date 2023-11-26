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

        // $botman->hears('pain|paracetamol|pain relief|fever|pain relief and fever', function ($botman){
        //     $botman->reply('We have this product
        //     PARACETAMOL + IBUPROFEN PAIN RELIEF and
        //     PARACETAMOL + IBUPROFEN FAST RELAX');
        // });

        // $botman->hears('memory|brain|brain and memory|herbal|supplement|vitamins|protection|improvement|medicine|body|stress|wellness|strength|endurance|health|healths|natural', function ($botman){
        //     $botman->reply('We have this product
        //     CURAMED for Brain and Memory');
        // });

        // $botman->hears('immunity', function ($botman){
        //     $botman->reply('We have this product
        //     DriveMax Plus Capsule, DriveMax Coffee, Guard-C Capsule, and NutriCleanse Herbal Capsule');
        // });

        // $botman->hears('multivitamins|food|supplement|syrup|vitamins|taurine|lysine|chlorella|growth|fruity|immune|system', function ($botman){
        //     $botman->reply('We have this product
        //     YummVit 120ml');
        // });

        // $botman->hears('{message}', function($botman, $message) {
  
        //     if ($message == "Hi") {
        //         $this->askName($botman);
        //     }else{
        //         $botman->reply('Command not found please type help for more info.');
        //     }
  
        // });

        // $botman->hears('sexual|sexual health vitamins', function ($botman){
        //     $botman->reply('We have this product
        //     DriveMax Plus Capsule and DriveMax Coffee');
        // });

        // $botman->hears('drinks|coffee', function ($botman){
        //     $botman->reply('We have this product
        //     Maxan Mangosteen Coffee and DriveMax Coffee');
        // });

        // $botman->hears('digestion|digestive|cleanse', function ($botman){
        //     $botman->reply('We have this product
        //     NutriCleanse');
        // });

        // $botman->hears('tea|soya|drink|energy|wellness|caffeine|acidic|colds|health|esteem|strengthen', function ($botman){
        //     $botman->reply('We have this product
        //     Power Cells 6in1 Salabat');
        // });

        // $botman->hears('heart and blood pressure|blood pressure|heart', function ($botman){
        //     $botman->reply('We have this product
        //     Power Cells Herbal Capsule');
        // });
        
        // $botman->fallback(function($bot) {
        //     $bot->reply('Sorry, I did not understand these commands.Please type "help" for more commands.');
        // });


        // $botman->hears('help', function($botman){
        //     $botman->reply("Type the type of product that you are looking for ex.(immunity, heart, sexual, digestion, cough, colds, headache, dizziness, stomachaches, pains, vitamins, growth, oil, energy, performance, capsule and pains)");
        // });

        $botman->hears('product related to digestion?|digestion', function ($botman)
        {
            $this->askDigestion($botman);
        });

        $botman->hears('do you have multivitamins for kids?|multivitamins for kids', function ($botman)
        {
            $this->askYummyVit($botman);
        });

        $botman->hears('do you have products for vitamin c?|vitamin c', function ($botman){
            $this->askVitaminC($botman);
        });

        $botman->hears('do you have products for improve sexual activity?|lovemaking|improve sexual', function ($botman){
            $this->askImproveSexual($botman);
        });
        
        $botman->hears('how to use {product}?', function ($botman,$product){
            if($product == 'drivemax coffee'){
                $botman->reply('The DMX Drivemax Coffee not only serves as a delightful beverage but also contributes to an enhanced overall quality of health. Particularly beneficial for women experiencing low libido, it stands out with its commendable absence of side effects. Sweetened exclusively with Stevia Leaf Extract and devoid of sugar, it accommodates health-conscious preferences. The inclusion of non-dairy creamer caters to varied dietary needs. Infused with Panax Ginseng, recognized for its positive impact on mood and immunity, and Rhodiola, a traditional Chinese medicine, this coffee is tailored to promote well-being. With these elements, it not only uplifts the spirit but also augments sexual activity, making it a holistic choice for those seeking a harmonious blend of health and pleasure.
                Pour 1 sachet of Drivemax Blend Coffee into a mug then add 220ml water then stir and enjoy.');
            }else if($product == 'guard c calcium ascorbate' || $product == 'guard c calcium' || $product == 'guard c'){
                $botman->reply('Guard C Calcium Ascorbate is a form of a non-acidic vitamin C supplement that helps prevent or treat low levels of vitamin C in people who do not get enough of the vitamins from their diets.
                Guard C should be taken 30 minutes after a meal with 1 capsule');
            }else if($product == 'drivemax herbal capsule'){
                $botman->reply('The Drivemax Herbal Capsule enhances various aspects of sexual well-being, offering a comprehensive solution to improve sexual activity. It is particularly effective in combating erectile dysfunction, promoting increased sexual arousal and libido. Notably, it contributes to the endurance and longevity of erections, ensuring a more satisfying and prolonged experience. For women, it brings about heightened clitoral sensation, adding an extra dimension to intimate moments. Beyond its specific benefits to sexual health, this product also contributes to overall well-being, making it a holistic choice for those seeking a multifaceted enhancement to their sexual and general health.
                Take Drivemax on an empty stomach and take 1 Capsule 30 Minutes before LOVEMAKING.');
            }else if($product == 'yummy vit'){
                $botman->reply('Yummy Vit is a multivitamin preparation that has for its main ingredients Taurine, Lysine and Chlorella Growth Factor. It is beneficial for bone, brain and body development. Yummy Vit Syrup is for children, 2 to 12 years old.
                Recommended use for Yummy Vit syrup is: 2-6 is 1/2 teaspoon once a day
                7-12 years old is 1-2 teaspoons once a day 
                ');
            }else if($product == 'maxan mangosteen xanthon capsule' || $product == 'maxan mangosteen capsule' || $product == 'mangosteen capsule') {
                $botman->reply('Maxan Mangosteen Xanthon Capsules are a nutritional food supplement designed to support overall health, enhance mental and sports-related performance, and boost the immune system. Packed with essential nutrients like vitamins, minerals, proteins, amino acids, and other beneficial substances, this supplement is formulated with natural ingredients such as Mangosteen, Malunggay leaves, and Barley Powder. Take 1 capsule daily or as recommended by a Physician');
            }else if($product == 'drivemax herbal capsule'){
                $botman->reply('The Drivemax Herbal Capsule enhances various aspects of sexual well-being, offering a comprehensive solution to improve sexual activity. It is particularly effective in combating erectile dysfunction, promoting increased sexual arousal and libido. Notably, it contributes to the endurance and longevity of erections, ensuring a more satisfying and prolonged experience. For women, it brings about heightened clitoral sensation, adding an extra dimension to intimate moments. Beyond its specific benefits to sexual health, this product also contributes to overall well-being, making it a holistic choice for those seeking a multifaceted enhancement to their sexual and general health.
                Take Drivemax on an empty stomach and take 1 Capsule 30 Minutes before LOVEMAKING.');
            }else if ($product == 'nutricleanse'){
               $botman->reply('Nutricleanse Herbal - It helps burn excess fats and bad cholesterol. It maintains a firmer; sexier and healthier body and fights Colon Cancer. It fights Bacteria and Viruses and prevents Obesity and Heart attack.
Instructions: Take 2 capsules 2 times a day 1 hour before each meals (Morning and Evening).');} else if ($product == 'paracetamol'){
               $botman->reply('
Paracetamol + ibuprofen Fast Relax Capsule and Paracetamol + ibuprofen Pain Relief Capsule is a medicine that is used for the treatment of Headache, Toothache, Ear Pain, Joint Pain, Periods Pain, Fever and other conditions. Adults can usually take 1 or 2 tablets (500mg) every 4-6 hours, but should not take more than 4g (8 x 500mg tablets) in the space of 24 hours Children under 16 need to take a lower dose.
');
}else if ($product == 'powercells salabat'){
               $botman->reply('Powercells Salabat 6 in 1 Herbal Mix Ginger Brew.Having powerful and effective ingredients: Ginger, Agaricus Mushroom, Gingko Biloba, Ginseng, and Lemon. Serving suggestion: 1. Pour contents into mug. 2. Add 220ml of Hot water 3. Stir well to enjoy the fragrance and taste of Powercells Salabat 6N1.');
}else if($product == 'curamed'){
                $botman->reply('
CuraMed Herbal Dietary Supplement Capsule is a herbal dietary supplement made from highly effective all-natural ingredients. 1 capsule daily, may increase as desired. My open capsule and mix with food.
');
}else if($product == 'powercells liniment'){
                $botman->reply('
Power Cells Liniment is made from Methyl Salicylate and Camphor, ingredients that are known for their soothing effect to relieve an assortment of muscle and skin problems such as muscle cramps, joint pains, arthritis, beriberi, lumbago, headache, itchiness and minor skin diseases. Directions: shake before use. Adults take 5 to 10 drops in 12 - 20ft oz. or more of distilled or purified water, or juice. Take 1 to 3 times a day for energy. After taking Power Cell for a month or more, may you increase drops up to 15 per dose.');
}else{
                $botman->reply('Sorry I did not understand please try again');
            }
        });

        $botman->listen();
    }

    public function askImproveSexual($botman){
        $botman->reply('Yes we have Drivemax Herbal Capsule');
        $botman->ask('Do you know how to use Drivemax Herbal Capsule?',[
            [
                'pattern' => 'yes',
                'callback' => function () {
                    $this->say('Okay! You may purchase it on this website. Happy shopping! :)');
                }
            ],
            [
                'pattern' => 'no',
                'callback' => function () {
                    $this->say('The Drivemax Herbal Capsule enhances various aspects of sexual well-being, offering a comprehensive solution to improve sexual activity. It is particularly effective in combating erectile dysfunction, promoting increased sexual arousal and libido. Notably, it contributes to the endurance and longevity of erections, ensuring a more satisfying and prolonged experience. For women, it brings about heightened clitoral sensation, adding an extra dimension to intimate moments. Beyond its specific benefits to sexual health, this product also contributes to overall well-being, making it a holistic choice for those seeking a multifaceted enhancement to their sexual and general health.
                    Take Drivemax on an empty stomach and take 1 Capsule 30 Minutes before LOVEMAKING.');
                }
            ]
        ]);
    }

    public function askVitaminC($botman){
        $botman->reply('Yes we have Guard C Calcium Ascorbate');
        $botman->ask('Do you know how to use Guard C Calcium Ascorbate?',[
            [
                'pattern' => 'yes',
                'callback' => function () {
                    $this->say('Okay! You may purchase it on this website. Happy shopping! :)');
                }
            ],
            [
                'pattern' => 'no|nope',
                'callback' => function () {
                    $this->say('Guard C Calcium Ascorbate is a form of a non-acidic vitamin C supplement that helps prevent or treat low levels of vitamin C in people who do not get enough of the vitamins from their diets.
                    Guard C should be taken 30 minutes after a meal with 1 capsule');
                }
            ]
        ]);
    }

    public function askYummyVit($botman)
    {
        $botman->reply('Yes we have Yummy Vit');
        $botman->ask('Do you know how to use Yummy Vit?', [
            [
                'pattern' => 'yes|yup',
                'callback' => function () {
                    $this->say('Okay! You may purchase it on this website, Happy shopping! :)');
                }
            ],
            [
                'pattern' => 'no|nope',
                'callback' => function () {
                    $this->say('Yummy Vit is a multivitamin preparation that has for its main ingredients Taurine, Lysine and Chlorella Growth Factor. 
                    It is beneficial for bone, brain and body development. Yummy Vit Syrup is for children, 2 to 12 years old.
                    Recommended use for Yummy Vit syrup is: 2-6 is 1/2 teaspoon once a day
                    7-12 years old is 1-2 teaspoons once a day.');
                    $this->say('Take note that this is not a cure for fever. Please consult your doctor before consuming.');
                }
            ]
        ]);
    }

    public function askDigestion($botman)
    {
        $botman->reply('Yes we have Nutricleanse');
        $botman->ask('Do you know how to use Nutricleanse',[
            [
                'pattern' => 'yes|yup',
                'callback' => function () {
                    $this->say('Okay! You may purchase it on this website. Happy shopping! :)');
                }
            ],
            [
                'pattern' => 'no|nope',
                'callback' => function () {
                    $this->say('Nutricleanse a powerful food supplement meticulously crafted to enhance your digestive system. Formulated to safeguard against colon cancer, diverticulitis, and chronic diarrhea, this potent blend stimulates peristalsis, the rhythmic muscular movement crucial for optimal colon function. Moreover, it facilitates the healing process of the mucous membrane lining throughout your entire digestive tract, promoting overall digestive health. Immerse yourself in the revitalizing benefits of our Herbal Capsule, a holistic approach to ensuring a resilient and harmonious digestive experience.
                    Take 2 Capsules 1 Hour before BREAKFAST and 2 Capsules 1 Hour before Dinner.');
                    $this->say('If problem persist please consult your doctor.');
                }
            ]
        ]);
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
