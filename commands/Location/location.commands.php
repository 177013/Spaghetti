<?php

include BASE_PATH . 'commands/Location/classes/Location.class.php';

$location = $bot->registerCommand('location', function(){});

$location->registerSubCommand('get', function($request, $args) {
	$location = Location::fetchByAddress( implode(' ', $args) );

	if ( count($location) == 0 ) {
		$response = 'No result found.';
	}
	else {
		$response = $location[0]->getFormattedAddress();
	}

	$request->channel->sendMessage( $response );
});