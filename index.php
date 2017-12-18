<?php

include dirname(__FILE__) . '/vendor/altorouter/altorouter/AltoRouter.php';

$router = new AltoRouter();

$router->setBasePath('/dashboard/');

// map homepage
$router->map( 'GET', '/', function() {
	require __DIR__ . '/views/home.php';
});

$router->map( 'GET', '/home', function() {
	require __DIR__ . '/views/home.php';
});
$router->map( 'GET', '/admin', function() {
	require __DIR__ . '/views/dashboard.php';
});
$router->map( 'GET', '/cat-add', function() {
	require __DIR__ . '/views/category-add.php';
});

$match = $router->match();

if( $match && is_callable( $match['target'])) {
	call_user_func_array( $match['target'], $match['params'] ); 
} else {
	// no route was matched
	require 'views/404.php';
}
?>