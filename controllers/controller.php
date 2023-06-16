<?php

class Controller
{
    private $_f3;
    private $user;

    function __construct($f3)
    {
        $this->_f3 = $f3;
        $this->user = $GLOBALS['dataLayer']->userInfo();
        $this->_f3->set('user', $this->user);
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
            // Get the form data
            $username = $_POST['username'] ?? "";
            $password = $_POST['password'] ?? "";

            // Validate the data
            if (empty($username) || empty($password)) {
                $this->alert('Username and password are required!');
            } else {
                if ($GLOBALS['dataLayer']->signIn($username, $password)) {
                    $this->alert('Sign in successful!');
                    $f3->reroute('/');
                } else {
                    $this->alert('Sign in failed!');
                }
            }
        }
        $view = new Template();
        echo $view->render('views/Login.html');
    }

    function logUp($f3)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get the form data
            $username = $_POST['username'] ?? "";
            $password = $_POST['password'] ?? "";

            // Validate the data
            if (empty($username) || empty($password)) {
                $this->alert('Username and password are required!');
            } else {
                if ($GLOBALS['dataLayer']->sighUp($username, $password)) {
                    $this->alert('Sign up successful!');
                } else {
                    $this->alert('Sign up failed!');
                }
            }
        }
        $view = new Template();
        echo $view->render('views/NewAccount.html');
    }

    function signOut()
    {
        session_destroy();
        $this->_f3->reroute('/');
    }

    function questTester($f3)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get the form data
            $vote = $_POST['vote'] ?? "";

            // Validate the data
            if (empty($vote)) {
                $this->alert('Vote is required!');
            } else {
                if ($GLOBALS['dataLayer']->vote($vote)) {
                    $this->alert('Vote successful!');
                } else {
                    $this->alert('Vote failed!');
                }
            }
        }

        $allQuests = $GLOBALS['dataLayer']->getAllQuest();
        $f3->set('allQuests', $allQuests);

        $view = new Template();
        echo $view->render('views/Quest.html');
    }

    function photoUpload()
    {
        if (!$this->user) {
            $this->_f3->reroute('/logIn');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get the form data
            $name = $_POST['name'] ?? "";
            $description = $_POST['description'] ?? "";

            // Validate the data
            if (empty($name)) {
                $this->alert('Name is required!');
            } else {
                // Get file
                $file = $_FILES['image'];

                // Check for errors
                if ($file['name'] == "") {
                    $this->alert('Please choose a file');
                } else {
                    // Check for errors
                    if ($file['error'] != 0) {
                        $this->alert('Please upload a valid file');
                    } else {
                        // Check file size
                        if ($file['size'] > 2000000) {
                            $this->alert('File size exceeds limit');
                        } else {
                            // Check file type
                            $fileType = mime_content_type($file['tmp_name']);
                            if ($fileType != 'image/jpeg' && $fileType != 'image/png' && $fileType != 'image/gif' && $fileType != 'image/webp' && $fileType != 'image/jpg') {
                                $this->alert('Invalid file type');
                            } else {
                                // Get file extension
                                $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);

                                // Upload file
                                $path = 'images/Uploads/';
                                $destination = md5($file['name']) . '_' . time() . '.' . $fileExtension;
                                move_uploaded_file($file['tmp_name'],$path . $destination);

                                // Add to database
                                if ($GLOBALS['dataLayer']->addPhoto($name, $description, $destination)) {
                                    $this->alert('File uploaded successfully');
                                } else {
                                    $this->alert('File upload failed');
                                }
                            }
                        }
                    }
                }
            }
        }
        $view = new Template();
        echo $view->render('views/UploadPhoto.html');
    }

    function alert($message)
    {
        echo "<script>alert('$message');</script>";
    }


}
