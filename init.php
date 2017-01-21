<?php
require 'config/config.php';
require 'vendor/autoload.php';
require 'config/libs.php';

# params resolver
require 'src/ParamsResolver.class.php';
$resolver = new ParamsResolver();
$startupTime = new DateTime();

$console->info('Starting up...');

/** Setup */
use Discord\DiscordCommandClient;
$bot = new DiscordCommandClient([
    'token' => TOKEN,
    'prefix' => PREFIX,
    'name' => NAME,
    'description' => DESCRIPTION,
]);

$bot->on('ready', function ($bot) use ($console) {
    $console->info('Booted up!');

    $bot->on('message', function($message) {

        # message logging to CLI
        if ( CHAT_LOG ) {
            echo "{$message->author->username}: {$message->content}", PHP_EOL;
        }

    });
});

include 'commands/core.commands.php';
#include 'commands/todo.commands.php';
include 'commands/fun.commands.php';
#include 'commands/Location/location.commands.php';
include 'commands/Food/food.commands.php';

$bot->run();