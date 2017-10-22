<?php

include dirname(__FILE__) . '/vendor/altorouter/altorouter/AltoRouter.php';

$router = new AltoRouter();

$router->setBasePath('');

$router->map('GET','/', 'views/home.php', 'home');

$router->map('GET','/admin', 'views/dashboard.php', 'dashboard');
$router->map('GET','/org-add', 'views/organization-add.php', 'category-add');

$router->map( 'GET', '/', function() {
    require __DIR__ . '/views/home.php';
});

$match = $router->match();
if($match) {
  require $match['target'];
}
else {
  header("HTTP/1.0 404 Not Found");
  require 'views/404.php';
}
?>