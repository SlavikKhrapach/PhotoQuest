<?php

class Controller
{
    private $_f3;

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }


    //F3 object

    function home()
    {
        echo $GLOBALS['dataLayer']->createIfNotExists();

        // Display a view page
        $view = new Template();
        echo $view->render('views/Home.html');
    }

    function currentQuests()
    {
        $view = new Template();
        echo $view->render('views/CurrentQuests.html');
    }

    function pastQuests()
    {
        $view = new Template();
        echo $view->render('views/PastQuests.html');
    }

    function aboutUs()
    {
        $view = new Template();
        echo $view->render('views/AboutUs.html');
    }

    function contactUs()
    {
        $view = new Template();
        echo $view->render('views/ContactUs.html');
    }

    function logIn($f3)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $f3->reroute('/');
        }
        $view = new Template();
        echo $view->render('views/Login.html');
    }

    function logUp($f3)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $f3->reroute('/');
        }
        $view = new Template();
        echo $view->render('views/NewAccount.html');
    }

    function questTester($f3)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $GLOBALS['dataLayer']->vote();
            echo "vote submitted successfully!";
            $f3->reroute('/');
        }
        $view = new Template();
        echo $view->render('views/Quest.html');
    }
}

