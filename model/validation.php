<?php

/**
 * 328/PhotoQuest/model/validation.php
 * Contains functions to validate data
 * in the PhotoQuest website
 * This is part of the MODEL
 */

class Validate
{
    /**
     * Sanitize a string by removing HTML tags and encoding special characters.
     *
     * @param string $string The string to sanitize
     * @return string The sanitized string
     */
    public static function sanitizeString($string)
    {
        // Remove HTML tags and encode special characters
        $sanitizedString = strip_tags($string);
        $sanitizedString = htmlspecialchars($sanitizedString, ENT_QUOTES | ENT_HTML5);

        return $sanitizedString;
    }

    /**
     * Validate a username.
     *
     * @param string $username The username to validate
     * @return string Empty string if the username is valid, otherwise an error message
     */
    public static function validateUsername($username)
    {
        // Sanitize the username
        $sanitizedUsername = self::sanitizeString($username);

        // Validate the username
        if (empty($sanitizedUsername)) {
            return "Username is required!";
        } elseif (strlen($sanitizedUsername) < 3) {
            return "Username must be at least 3 characters long!";
        } elseif (strlen($sanitizedUsername) > 50) {
            return "Username cannot exceed 50 characters!";
        }
        return ""; // Empty string indicates no validation errors
    }

    /**
     * Validate a password.
     *
     * @param string $password The password to validate
     * @return string Empty string if the password is valid, otherwise an error message
     */
    public static function validatePassword($password)
    {
        // Sanitize the password
        $sanitizedPassword = self::sanitizeString($password);

        // Validate the password
        if (empty($sanitizedPassword)) {
            return "Password is required!";
        } elseif (strlen($sanitizedPassword) < 6) {
            return "Password must be at least 6 characters long!";
        } elseif (strlen($sanitizedPassword) > 50) {
            return "Password cannot exceed 50 characters!";
        }
        return ""; // Empty string indicates no validation errors
    }

    /**
     * Validate a name.
     *
     * @param string $name The name to validate
     * @return string Empty string if the name is valid, otherwise an error message
     */
    public static function validateName($name)
    {
        // Sanitize the name
        $name = trim($name);
        $name = htmlspecialchars($name, ENT_QUOTES);

        // Validate the name
        if (empty($name)) {
            return "Name is required.";
        }

        // Additional validation rules for name if needed

        return ""; // No error
    }

    /**
     * Validate an email address.
     *
     * @param string $email The email address to validate
     * @return string Empty string if the email is valid, otherwise an error message
     */
    public static function validateEmail($email)
    {
        // Sanitize the email
        $email = trim($email);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        // Validate the email
        if (empty($email)) {
            return "Email is required.";
        }

        // Check if the email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email format.";
        }

        // Additional validation rules for email if needed

        return ""; // No error
    }

    /**
     * Validate a message.
     *
     * @param string $message The message to validate
     * @return string Empty string if the message is valid, otherwise an error message
     */
    public static function validateMessage($message)
    {
        // Sanitize the message
        $message = trim($message);
        $message = htmlspecialchars($message, ENT_QUOTES);

        // Validate the message
        if (empty($message)) {
            return "Message is required.";
        }

        // Additional validation rules for message if needed

        return ""; // No error
    }
}