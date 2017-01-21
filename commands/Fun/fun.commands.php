<?php

$bot->registerCommand('dice', function($request, $args) {
	$dices = 1;
	$response = '';

	# check args
	if ( count($args) == 0 || !is_numeric( $args[0] ) ) {
		$response .= "You didn't specify a number of dices, so I'm just gonna throw one!\n";
	}
	else {
		$dices = $args[0];
	}

	# throw dices
	for ( $i = 1, $sum = 0; $i <= $dices; $i++ ) {
		# generate and sum number
		$sum += $rand = mt_rand(0,6);
		$response .= ("#$i: $rand\n");
	}

	# say sum
	$response .= "The sum of the $dices dices turned out to be: $sum\n";

	$request->channel->sendMessage($response);
});

/**
 * Sends the given message
 */
$bot->registerCommand('say', function($request, $args) {
	$request->channel->sendMessage( implode(' ', $args) );
}, [
	'description' => 'Says something, suh',
	'aliases' => ['tell']
]);

/**
 * Gives random answer to question
 */
$bot->registerCommand('ask', function($request, $args) {
	$replies = [
		'Yes.', 'No', 'Maybe.',
		'Not sure about that.',
		'I don\'t currently feel like answering.',
		'That\'s for sure.', 'Why would that be?',
		'Whatever you say, I guess', 'Yeah.', 'Yaaay.', 'Nay.',
		'Ah-Ah. So funny. Dear God be glad I don\'t have a will of my own.',
		'Well... Probably.', 'That\'s likely.', 'Not a chance.',
		'No way in hell.', 'Sure as hell.', 'Sure as fuck.', 'Sure as heck.',
	];
	$request->channel->sendMessage( $replies[array_rand($replies)] );
});