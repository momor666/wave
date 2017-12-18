<?php
namespace app\Controllers;
use \core\View;
/**
 * Home controller
 */
class Home extends \Core\Controller
{
    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        View::renderTemplate('home/index.html');
    }
}