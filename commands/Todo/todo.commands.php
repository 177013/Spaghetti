<?php
/**
 * Aliases
 */

/**
 * Master command, does nothing. Just gives some help text.
 */
$todo = $bot->registerCommand('todo', function($request){
	$request->channel->sendMessage("
		This is a group of utilities that let you keep
		track of a simple timezone_open()-do list linked to your account.\n
		Please type `{PREFIX}help todo` to obtain the list of 
		commands.
	");
}, [
	'description' => 'List of useful commands to handle a simple todo-list.'
]);

/**
 * Add item
 */
$todo->registerSubCommand('add', function($request, $args) {
	$request->channel->sendMessage('Added: '.implode(' ', $args));
}, [
	'description' => 'Adds an item to the todo list.',
	'aliases' => ['create', 'insert', 'push']
]);

/**
 * Remove item
 */
$todo->registerSubCommand('remove', function($request, $args) {
	$request->channel->sendMessage('Removed: '.implode(' ', $args));
}, [
	'description' => 'Removes an item from the todo list.',
	'aliases' => ['pop']
]);

/**
 * Reset
 */
$todo->registerSubCommand('reset', function() {
	return ', I just emptied your todo list.';
}, [
	'description' => 'Empties one\'s todo list.',
	'aliases' => ['startover']
]);