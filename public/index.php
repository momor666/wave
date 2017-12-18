<?php
/**
 * Front controller
 */
require dirname(__DIR__) . '/vendor/autoload.php';
/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('core\Error::errorHandler');
set_exception_handler('core\Error::exceptionHandler');
/**
 * Routing
 */
$router = new core\Router();
// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('{controller}/{action}');
    
$router->dispatch($_SERVER['QUERY_STRING']);