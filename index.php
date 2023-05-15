<?php
/*
 * Slavik Khrapach
 * 5/11/2023
 * 328/PhotoQuest/index.php
 * Controller for howdy project
 *
 */

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require the autoload file
require_once('vendor/autoload.php');

// Create an F3 (Fat-Free Framework) object
$f3 = Base::instance();

// Define a default route
$f3->route('GET /', function() {

    $view = new Template();
    echo $view->render('views/info.html');

});
// Define a homepage route
$f3->route('GET /', function() {

    $view = new Template();
    echo $view->render('views/homepage.html');

});
// Run the Fat-Free
$f3->run();