<?php

$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

switch ($request_uri[0]) {
    case '/':
        require 'views/home.php';
        break;
    case '/org':
        require 'views/organization.php';
        break;
    case '/cat-add':
        require 'views/category-add.php';
        break;
    case '/dashboard':
        require 'views/dashboard.php';
        break;
    default:
        
        require 'views/404.php';
        break;
}