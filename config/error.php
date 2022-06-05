<?php
use App\Error\ItoolError;

$config = [ 
	'errorLevel' 		=> E_ALL & ~ E_DEPRECATED,
	'exceptionRenderer' => 'App\Error\ItoolExceptionRenderer',
	'skipLog' 			=> [],
	'log' 				=> true,
	'trace' 			=> true 
];

$errorHandler = new ItoolError($config);
$errorHandler->register();