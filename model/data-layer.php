<?php
/**
 * 328/PhotoQuest/model/data-layer.php
 * Returns data for the PhotoQuest website
 * Reads/writes the DB
 * This is part of the MODEL
*/

//connect the database
require_once($_SERVER['DOCUMENT_ROOT'].'/../pdo-config-photoquest.php');
/**
 * Class DataLayer
 */
class DataLayer
{
    /**
     * @var PDO Database connection object
     */
    private $_dbh;

    /**
     * DataLayer constructor.
     */
    function __construct()
    {
        try {
            //Instantiate a database object
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            //echo 'Connected to database!!';
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Sign up a new user.
     *
     * @param string $username The username
     * @param string $password The password
     * @return bool True if sign up is successful, false otherwise
     */
    function signUp($username, $password)
    {
        // Check if the username already exists
        $sql = "SELECT * FROM accounts WHERE username = :username";

        // Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // Bind the parameters
        $statement->bindParam(':username', $username, PDO::PARAM_STR);

        // Execute
        $statement->execute();

        // Process the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Return the result
        if ($result) {
            return false;
        }

        // Create token
        $token = password_hash($password . time(), PASSWORD_DEFAULT);

        // Insert into database
        $sql = "INSERT INTO accounts (username, password, token) VALUES (:username, :password, :token)";

        // Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // Bind the parameters
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->bindParam(':password', md5($password), PDO::PARAM_STR);
        $statement->bindParam(':token', $token, PDO::PARAM_STR);

        // Execute
        $statement->execute();

        // Process the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Return the result
        if ($result) {
            return false;
        }

        return true;
    }

    /**
     * Sign in a user.
     *
     * @param string $username The username
     * @param string $password The password
     * @return bool True if sign in is successful, false otherwise
     */
    function signIn($username, $password)
    {
        // Get the account from the database
        $sql = "SELECT * FROM accounts WHERE username = :username AND password = :password";

        // Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // Bind the parameters
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->bindParam(':password', md5($password), PDO::PARAM_STR);

        // Execute
        $statement->execute();

        // Process the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Return the result
        if ($result) {
            $_SESSION['token'] = $result[0]['token'];
            return true;
        }

        return false;
    }

    /**
     * Get all quests.
     *
     * @return array The array of quests
     */
    function getAllQuest()
    {
        $sql = "SELECT * FROM photos";

        // Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // Execute
        $statement->execute();

        // Process the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Return the result
        if ($result) {
            return $result;
        }

        return [];
    }

    /**
     * Vote for a photo.
     *
     * @param int $photo_id The photo ID
     * @return bool True if the vote is successful, false otherwise
     */
    function vote($photo_id)
    {
        // Check if photo exists
        $sql = "SELECT * FROM photos WHERE id = :id";

        // Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // Bind the parameters
        $statement->bindParam(':id', $photo_id, PDO::PARAM_INT);

        // Execute
        $statement->execute();

        // Process the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Return the result
        if (!$result) {
            return false;
        }

        // Check if logged in
        $user = $this->userInfo();

        if (!$user) {
            return false;
        }

        // Check if user already voted
        $sql = "SELECT * FROM votes WHERE account_id = :account_id AND photo_id = :photo_id";

        // Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // Bind the parameters
        $statement->bindParam(':account_id', $user['id'], PDO::PARAM_INT);
        $statement->bindParam(':photo_id', $photo_id, PDO::PARAM_INT);

        // Execute
        $statement->execute();

        // Process the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Return the result
        if ($result) {
            return false;
        }

        // Insert into database
        $sql = "INSERT INTO votes (account_id, photo_id) VALUES (:account_id, :photo_id)";

        // Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // Bind the parameters
        $statement->bindParam(':account_id', $user['id'], PDO::PARAM_INT);
        $statement->bindParam(':photo_id', $photo_id, PDO::PARAM_INT);

        // Execute
        $statement->execute();

        // Process the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Return the result
        if ($result) {
            return false;
        }

        return true;
    }

    /**
     * Get user information.
     *
     * @return array|bool The user information if logged in, false otherwise
     */
    function userInfo()
    {
        // Check if logged in
        if (!isset($_SESSION['token'])) {
            return false;
        }

        // Get the account from the database
        $sql = "SELECT * FROM accounts WHERE token = :token";

        // Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // Bind the parameters
        $statement->bindParam(':token', $_SESSION['token'], PDO::PARAM_STR);

        // Execute
        $statement->execute();

        // Process the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Return the result
        if ($result) {
            return $result[0];
        }

        return false;
    }

    /**
     * Add a photo.
     */
    function addPhoto()
    {
        // $sql = "INSERT";
    }

    /**
     * Create the "UploadedPhotos" table if it doesn't exist.
     *
     * @return bool True if the table creation is successful, false otherwise
     */
    function createIfNotExists()
    {
        // 1. Define the query (test first!)
        $sql = "CREATE TABLE IF NOT EXISTS UploadedPhotos (
                 username VARCHAR(50) NOT NULL ,
                 photo BLOB NOT NULL ,
                 votes INT(4) NOT NULL DEFAULT '0' ,
                 quest VARCHAR(50) NOT NULL ,
                 date DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
                 UNIQUE (`username`, `quest`)) ENGINE = InnoDB;
         )";

        // 2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // 3. Bind the parameters

        // 4. Execute
        $statement->execute();

        // 5. Process the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
