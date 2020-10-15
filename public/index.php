<?php

use App\Core\Init;
use function Http\Response\send;
use GuzzleHttp\Psr7\ServerRequest;
use App\Controllers\IndexController;
use App\Controllers\ListingController;

require_once(dirname(__DIR__).DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php");

$controllerslist = [IndexController::class,ListingController::class];

$init = new Init($controllerslist);
$response = $init->run(ServerRequest::fromGlobals());
send($response);
