<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/../pdo-config-photoquest.php');

class DataLayer {

    private $_dbh;

    function __construct()
    {
        try {
            //Instantiate a database object
            $this->_dbh = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
            //echo 'Connected to database!!';
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

     function sighUp()
     {
        $sql = "";
     }

    function addPhoto()
    {
        $sql = "INSERT";
    }

    function createIfNotExists() // todo it will go away
    {
        //1. Define the query (test first!)
        $sql = "CREATE TABLE IF NOT EXISTS UploadedPhotos (
                username VARCHAR(50) NOT NULL , 
                photo BLOB NOT NULL , 
                votes INT(4) NOT NULL DEFAULT '0' ,
                quest VARCHAR(50) NOT NULL ,
                date DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
                UNIQUE (`username`, `quest`)) ENGINE = InnoDB;
        )";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters

        //4. Execute
        $statement->execute();

        //5. Process the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function vote()
    {
        $sql = "SELECT votes
                FROM UploadedPhotos 
                WHERE username 'Alex'";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters

        //4. Execute
        $statement->execute();

        $savedVotes = $statement->fetchAll(PDO::FETCH_ASSOC);
        $savedVotes++;

        $sql = "INSERT INTO UploadedPhotos (votes)
        VALUES ($savedVotes)";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters

        //4. Execute
        $statement->execute();
    }


    function uploadPhoto()
    {

        $username = $_POST['username'];
        $quest = $_POST['quest'];
        // Prepare the SQL statement
        $sql = "INSERT INTO UploadedPhotos (username, photo, quest) VALUES (?, ?, ?)";

        // Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        $username = 'Alex';
        $quest = 'Strawberry pie';
        // Bind the parameters
        $statement->bindParam(1, $username);
        $statement->bindParam(2, $photo, PDO::PARAM_LOB); // Use PDO::PARAM_LOB for BLOB data
        $statement->bindParam(3, $quest);

        // Execute the statement
        $statement->execute();

        // Check if the image was successfully inserted
        if ($statement->rowCount() > 0) {
            return true; // Image saved successfully
        } else {
            return false; // Failed to save image
        }

        // Return JSON response
        $response = array('success' => true);
        echo json_encode($response);
        exit();
    }
}