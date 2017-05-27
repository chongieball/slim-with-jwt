<?php 

use Slim\Container;
use Slim\Middleware\JwtAuthentication;
use App\Extensions\Jwt\Token;

$container = $app->getContainer();

$container["token"] = function ($container) {
    return new StdClass;
};

$container['jwt'] = function (Container $container) {
	return new JwtAuthentication([
		'path'			=> '/',
		'passthrough'	=> ['/api/login', '/api/token', '/dump'],
		'attribute'		=> 'token',
		'secret'		=> getenv("JWT_SECRET"),
		'callback' 		=> function ($req, $res, $args) use ($container) {
		            $container['token'] = $args['decoded'];
		},
	]);
};