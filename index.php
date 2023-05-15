<?php
/*
 * Slavik Khrapach
 * 5/11/2023
 * 328/PhotoQuest/index.php
 * Controller for PhotoQuest project
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

<<<<<<< HEAD
$f3->route('GET /current-competitions', function() {

    $view = new Template();
    echo $view->render('views/CurrentCompetitions.html');

});

=======
    $view = new Template();
    echo $view->render('views/homepage.html');

});
>>>>>>> 993034bcad324b451417437cab3ef9da9803d534
// Run the Fat-Free
$f3->run();