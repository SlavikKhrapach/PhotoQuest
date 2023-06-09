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
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get the form data
            $name = $_POST['name'] ?? "";
            $email = $_POST['email'] ?? "";
            $message = $_POST['message'] ?? "";

            // Validate the data
            $nameError = Validate::validateName($name);
            $emailError = Validate::validateEmail($email);
            $messageError = Validate::validateMessage($message);

            // Check for any errors
            if (!empty($nameError)) {
                $errors['name'] = $nameError;
            }
            if (!empty($emailError)) {
                $errors['email'] = $emailError;
            }
            if (!empty($messageError)) {
                $errors['message'] = $messageError;
            }

            // If there are no errors, process the form
            if (empty($errors)) {
                // Process the form, send email, save to database, etc.
                // ...

                // Display success message
                $this->_f3->set('success', 'Message sent successfully!');
            }
        }

        // Pass the errors and success message to the view
        $this->_f3->set('errors', $errors);

        $view = new Template();
        echo $view->render('views/ContactUs.html');
    }

    function logIn($f3)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get the form data
            $username = $_POST['username'] ?? "";
            $password = $_POST['password'] ?? "";

            // Sanitize and validate the username
            $usernameError = Validate::validateUsername($username);

            // Sanitize and validate the password
            $passwordError = Validate::validatePassword($password);

            // Check for validation errors
            if (!empty($usernameError) || !empty($passwordError)) {
                // Display validation errors
                $this->alert($usernameError . ' ' . $passwordError);
            } else {
                // Validation successful, proceed with login logic
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

            // Sanitize and validate the username
            $usernameError = Validate::validateUsername($username);

            // Sanitize and validate the password
            $passwordError = Validate::validatePassword($password);

            // Check for validation errors
            if (!empty($usernameError) || !empty($passwordError)) {
                // Display validation errors
                $this->alert($usernameError . ' ' . $passwordError);
            } else {
                // Validation successful, proceed with sign-up logic
                if ($GLOBALS['dataLayer']->signUp($username, $password)) {
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

    function alert($message)
    {
        echo "<script>alert('$message');</script>";
    }


}