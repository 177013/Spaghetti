<?php
/*
 * Uses RecipePuppy API to give info about various recipes
 * TODO: search by ingredients
 */

include BASE_PATH . 'commands/Food/classes/Recipe.class.php';

$food = $bot->registerCommand('food', function($request, $args) use ($bot, $resolver) {
	# get'em
	$searchQuery = implode(' ', $args);
	$recipes = Recipe::search($searchQuery);

	if ( count($recipes) == 0 ) {
		$request->channel->sendMessage("Couldn't find anything.");
	}
	else {
		$recipe = $recipes[0];

		# sender info
		$user = $request->author->user;
		$em_author = [
			'name' => "{$user->username}#{$user->discriminator}",
			'icon_url' => $user->avatar,
			'url' => $user->avatar,
		];

		# footer
		$em_footer = [
			'text' => 'source: recipepuppy.com',
			'icon_url' => 'http://allah.airforce/cdn/assets/icon/recipePuppy.png',
		];

		# grab role colors, fallback to random
		# if not a single role is present
		$em_color = $request->author->getRolesAttribute()->get(0)->color ?? rand(1, 16777215);

		# fields
		$em_fields = [
			[
				'name' => 'Ingredients',
				'value' => $recipe->getIngredients(),
			],
		];

		# build embed
		$embed = [
			'title' => html_entity_decode($recipe->getTitle()),
			'description' => "Results for \"{$searchQuery}\"",
			'type' => 'Recipe',
			'thumbnail' => [ 'url' => $recipe->getThumbnail(), ],
			'url' => $recipe->getHref(),
			'author' => $em_author,
			'provider' => 'http://www.recipepuppy.com/',
			'color' => $em_color,
			'fields' => $em_fields,
			'footer' => $em_footer,
		];

		$embed = $bot->factory(\Discord\Parts\Embed\Embed::class, $embed);
		
		# send that shit
		$request->channel->sendMessage(null, null, $embed);
	}
});