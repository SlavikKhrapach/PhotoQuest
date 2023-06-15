<?php

class Validate
{
    public static function sanitizeString($string)
    {
        // Remove HTML tags and encode special characters
        $sanitizedString = strip_tags($string);
        $sanitizedString = htmlspecialchars($sanitizedString, ENT_QUOTES | ENT_HTML5);

        return $sanitizedString;
    }

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