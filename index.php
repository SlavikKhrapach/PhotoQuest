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

$f3->route('GET /current-competitions', function() {

    $view = new Template();
    echo $view->render('views/CurrentCompetitions.html');

});


//Define a login route
$f3->route('GET|POST /loginpage', function($f3) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $f3->reroute('/');
    }
    $view = new Template();
    echo $view->render('views/login.html');
}
);

//Define an account creation route
$f3->route('GET|POST /createaccount', function($f3) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $f3->reroute('/');
    }
    $view = new Template();
    echo $view->render('views/newaccount.html');
}
);

//New home page experiment
$f3->route('GET /homepage', function($f3) {

    $view = new Template();
    echo $view->render('views/new-homepage.html');
}
);

// posts user data from login page to the database
//$f3->route('GET|POST /personexperience', function($f3) {
//    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
//        $f3->reroute('openings');
//    }
//    $view = new Template();
//    echo $view->render('views/experience.html');
//}
//);

// Run the Fat-Free
$f3->run();