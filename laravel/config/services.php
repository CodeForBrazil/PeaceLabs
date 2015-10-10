<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/

	'mailgun' => [
		'domain' => env('MAILGUN_DOMAIN'),
		'secret' => env('MAILGUN_SECRET'),
	],

	'mandrill' => [
		'secret' => env('MANDRILL_SECRET'),
	],

	'ses' => [
		'key'    => env('SES_KEY'),
		'secret' => env('SES_SECRET'),
		'region' => 'us-east-1',
	],

	'stripe' => [
		'model'  => 'App\User',
		'key'    => env('STRIPE_KEY'),
		'secret' => env('STRIPE_SECRET'),
	],

	/*
	 * Socialite Credentials
	 * Redirect URL's need to be the same as specified on each network you set up this application on
	 * as well as conform to the route:
	 * http://localhost/public/auth/login/SERVICE
	 * Where service can github, facebook, twitter, or google
	 */

	'github' => [
		'client_id' => env('GITHUB_CLIENT_ID'),
		'client_secret' => env('GITHUB_CLIENT_SECRET'),
		'redirect' => env('GITHUB_REDIRECT'),
	],

	'facebook' => [
		'client_id' => env('FACEBOOK_CLIENT_ID'),
		'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
		'redirect' => env('FACEBOOK_REDIRECT'),
	],

	'twitter' => [
		'client_id' => env('TWITTER_CLIENT_ID'),
		'client_secret' => env('TWITTER_CLIENT_SECRET'),
		'redirect' => env('TWITTER_REDIRECT'),
	],

	'google' => [
		'client_id' => env('GOOGLE_CLIENT_ID'),
		'client_secret' => env('GOOGLE_CLIENT_SECRET'),
		'redirect' => env('GOOGLE_REDIRECT'),
	],
];
