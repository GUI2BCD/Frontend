<?php
/**
 * University of Massachusetts Lowell
 * GUI Programming II, Prof. Jesse Heines
 *
 * Last Resort Recovery
 * Authors - David Jelley, Jr.
 *           Cameron Morris
 *           Benjamin Cao
 *
 * Description: This file contains the functions which manage the session
 *              This includes login authenication
 */
include_once 'config.php';

class Session
{

    public static function startSecureSession ()
    {
        // Name of session
        $sessionName = "lastresort_id";
        // Use only cookies
        if (! ini_set('session.use_only_cookies', 1)) {
            die('Could not initiate secure session<br>');
        }
        
        // Setup cookie parameters
        $cookieParams = session_get_cookie_params();
        
        session_set_cookie_params($cookieParams["lifetime"], 
                $cookieParams["path"], SECURE, true);
        // Name session
        session_name($sessionName);
        // Begin session
        session_start();
        // Resets ID
        session_regenerate_id();
    }

    public static function login ($email, $password, $connection)
    {
        $sql = "SELECT id, username, password, salt " . " FROM users" .
                 " WHERE email = ? LIMIT 1";
        // Prepare MySQL statement
        if ($result = $connection->prepare($sql)) {
            // Binds ? to $email
            $result->bind_param('s', $email);
            // Executes the query
            $result->execute();
            // Stores result
            $result->store_result();
            
            // Get results from database and store
            $result->bind_result($userid, $username, $dbpassword, $salt);
            $result->fetch();
            
            // Hash client password with salt
            $password = hash('sha512', $password . $salt);
            
            // User exists
            if ($result->num_rows == 1) {
                // Check password
                if ($dbpassword == $password) {
                    // Valid password, set session variables
                    $browserAgent = $_SERVER['HTTP_USER_AGENT'];
                    // Sanitize userid
                    $userid = preg_replace("/[^0-9]+/", "", $userid);
                    // Sanitize username
                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", 
                            $username);
                    
                    // Set session variables
                    $_SESSION['username'] = $username;
                    $_SESSION['loginString'] = hash('sha512', 
                            $password . $browserAgent);
                    
                    // Login successful
                    return true;
                }
            }
        }
    }
}