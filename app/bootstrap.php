<?php 

session_start();

require __DIR__. '/../vendor/autoload.php';

use Slim\App;

$dotenv = new Dotenv\Dotenv(__DIR__.'/..');
$dotenv->load();

$app = new App([
	'settings'	=> require __DIR__. '/settings.php'
	]);

require __DIR__. '/containers.php';
require __DIR__. '/middlewares.php';
require __DIR__. '/routes.php';