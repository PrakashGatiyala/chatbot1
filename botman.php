<?php

require_once 'vendor/autoload.php';

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Cache\SymfonyCache;
use BotMan\BotMan\Drivers\DriverManager;

require_once('OnboardingConversation.php');

$config = [];

DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);

$adapter = new FilesystemAdapter();

$botman = BotManFactory::create($config, new SymfonyCache($adapter));

/*
$botman->hears('Hello', function($bot) {
    
    $bot->startConversation(new OnboardingConversation);
    
});
*/

$botman->hears('Hi', function ($bot) {
    $bot->reply('Hello!');
    $bot->reply('What\' is your name');
});

$botman->hears('I\'m {name}',function($bot,$name){
    $bot->reply('Welcome '.$name);
    $bot->reply('What are you looking for?');
});

$botman->fallback(function($bot) {
    $bot->reply('Here is a list of things that I help you: ...');
    $bot->reply('Just type the query you are looking for! For example Type 1 for What would be the tentative cost for Hosting?');
     $txt = "1.What would be the    tentative cost for Hosting?";
     $bot->reply($txt);
    //$bot->reply("1.What would be the tentative cost for Hosting?");                                                                                                                      
    $bot->reply("2.What kind of technology is required to run a Virtual Trade Show?"); 
    $bot->reply("3.How many visitors and exhibitors can the Virtual Trade Show host? ");
    $bot->reply("4.How can the event participation be monetized?");
    $bot->reply("5.What kind of lead generation and lead qualification tools are available?");
});


$botman->hears('1', function ($bot) {
    $bot->reply('Let us know the no.of visitors per day and exact no.of days for the    event. We can give you the approximate costing.');
});
$botman->hears('2',function($bot){
	$bot->reply('It runs on the cloud so you or your participants don’t need to install software to access the online Trade Show. All you need is a standard web browser and a stable internet connection.');
});

$botman->hears('3',function($bot){
    $bot->reply('The Virtual Trade Show can have an unlimited number of exhibitor booths and can sustain thousands of visitors at any given time.');
});
$botman->hears('4',function($bot){
    $bot->reply('Exhibitors can be charged for virtual booth space and for branding across the virtual landscape. You can also charge attendees for entrance by either requesting them to purchase an online ticket or pay a participation fee at the time of login.');
});
$botman->hears('5',function($bot){
    $bot->reply('Lead management is as important as the event itself. We have multiple ways to help you capture, track, and optimize leads. You can also export survey and registration information to your customer relationship management and marketing automation databases.');
});

/*
$botman->hears('my name is {name}',function($bot,$name){
	$bot->reply('Welcome '.$name);
});
$botman->hears('.*Bonjour.*', function ($bot) {
    $bot->reply('Nice to meet you!');
});
*/
$botman->hears('Okay', function ($bot) {
   // $bot->typesAndWaits(2); 
    $bot->reply("okay!");
});
// 
/*
$botman->hears('keyword', function ($bot) {
    $bot->typesAndWaits(2);
    $bot->reply("Tell me more!");
});

$botman->hears('foo', 'MyBotCommands@handleFoo');

class MyBotCommands {

    public function handleFoo($bot) {
        $bot->reply('Hello World Prakash');
    }

}*/

/*
$botman->fallback(function($bot) {
    $bot->reply('Sorry, I did not understand these commands. Here is a list of commands I understand: ...');
});*/



$botman->listen();