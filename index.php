<?php
header("Content-Type: text/html");

include dirname(__FILE__) . '/vendor/altorouter/altorouter/AltoRouter.php';
$router = new AltoRouter();

$router->setBasePath('');

$router->map('GET','/', 'home.php', 'home');
$router->map('GET','/home/', 'home.php', 'home-home');

$match = $router->match();
if($match) {
  require $match['target'];
}
else {
  header("HTTP/1.0 404 Not Found");
  require 'views/404.php';
}
?>