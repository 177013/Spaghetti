<?php

/**
 * Replies with `pong`
 */
$bot->registerCommand('ping', function($request) {
	return 'pong!';
}, [
	'description' => 'pong!'
]);

/**
 * Update bot running game
 */
$bot->registerCommand('game', function($request, $args) use ($bot) {
	$newGame = $bot->factory(\Discord\Parts\User\Game::class, [
		'name' => implode(' ', $args),
	]);
	$bot->updatePresence($newGame);
});

/**
 * Shuts down the bot, ends the script.
 */
$bot->registerCommand('shutdown', function($request) use ($bot) {
	$request->channel->sendMessage('well, fuck you too.');
	$bot->close();
	die();
}, [
	'description' => 'Shuts down the bot.',
	'aliases' => ['close', 'sh', 'exit', 'quit', 'kill', 'goAwayNigger']
]);

$bot->registerCommand('uptime', function($request) use ($console, $startupTime) {
	$currentTime = new DateTime();
	$interval = $startupTime->diff($currentTime);
	$uptime = [
		'years'   => $interval->format('%y'),
		'months'  => $interval->format('%m'),
		'days'    => $interval->format('%d'),
		'hours'   => $interval->format('%h'),
		'minutes' => $interval->format('%i'),
		'seconds' => $interval->format('%s'),
	];
	$request->channel->sendMessage("
		I've been running without stop for {$uptime['months']} months, {$uptime['days']} days, {$uptime['hours']} hours, {$uptime['minutes']} minutes and {$uptime['seconds']} seconds.
	");
});

$bot->registerCommand('eval', function($request, $args) {
	if ( $request->author->id != DEV ) {
		return 'you are not the one.';
	}
	eval(implode(' ', $args));
});

$bot->registerCommand('meval', function($request, $args) {
	if ( $request->author->id != DEV ) {
		return 'you are not the one.';
	}

	eval('$request->channel->sendMessage('.implode(' ', $args).');');
});