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
require_once('controllers/controller.php');

// Connect to Database
$dataLayer = new DataLayer();

// Create an F3 (Fat-Free Framework) object
$f3 = Base::instance();
session_start();

//Create an instance of the Controller class
$controller = new Controller($f3);

// Define a default route
$f3->route('GET /', [$controller, 'home']);

$f3->route('GET /current-quests', [$controller, 'currentQuests']);

$f3->route('GET /past-quests', [$controller, 'pastQuests']);

$f3->route('GET|POST /login', [$controller, 'logIn']);

$f3->route('GET|POST /new-account', [$controller, 'logUp']);


$f3->route('GET /about-us', [$controller, 'aboutUs']);

$f3->route('GET /contact-us', [$controller, 'contactUs']);

$f3->route('POST /upload', [$controller, 'uploadPhoto']);

// Test pages
$f3->route('GET|POST /questTester', [$controller, 'questTester']);




// Run the Fat-Free
$f3->run();