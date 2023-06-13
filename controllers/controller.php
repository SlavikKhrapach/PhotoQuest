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
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $f3->reroute('/');
        }
        $view = new Template();
        echo $view->render('views/Login.html');
    }

    function logUp($f3)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $f3->reroute('/');
        }
        $view = new Template();
        echo $view->render('views/NewAccount.html');
    }

    function questTester()
    {
        $view = new Template();
        echo $view->render('views/Quest.html');
    }

    function photoUpload()
    {
        // Check if a file was uploaded
        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Get the uploaded file details
            $fileName = $_FILES['image']['name'];
            $tempFilePath = $_FILES['image']['tmp_name'];

            // Move the file to a folder
            $targetFolder = 'uploads/';
            $targetFilePath = $targetFolder . $fileName;
            move_uploaded_file($tempFilePath, $targetFilePath);

            // Store file details in the database
            echo $GLOBALS['dataLayer']->createIfNotExists($fileName);

            // Redirect or display success message
            // Your code here
        } else {
            // Handle upload error
            // Your code here
        }

    }
}
