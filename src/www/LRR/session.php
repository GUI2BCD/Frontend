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
namespace LastResortRecovery

{

    include_once 'config.php';

    class Session
    {

        /**
         * Creates a secure session which allows only cookies to be used.
         */
        public static function startSecureSession()
        {
            // Name of session
            $sessionName = "lastresort_id";
            // Setup cookie parameters
            $cookieParams = session_get_cookie_params();
            
            session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], false, true);
            // Name session
            session_name($sessionName);
            // Begin session
            session_start();
            // Resets ID
            session_regenerate_id();
        }

        /**
         * Checks a user's email and password against the database.
         * Creates session variables if valid
         *
         * @param string $email
         *            User's email address
         * @param string $password
         *            User's password
         * @param object $connection
         *            MySQL connection object
         * @return boolean whether the login was sucessful or not
         */
        public static function login($email, $password, $connection)
        {
            $sql = "SELECT id, username, password, salt FROM users WHERE email = ? LIMIT 1";
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
                        $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username);
                        
                        // Set session variables
                        $_SESSION['userid'] = $userid;
                        $_SESSION['username'] = $username;
                        $_SESSION['loginString'] = hash('sha512', $password . $browserAgent);
                        
                        // Login successful
                        return true;
                    } else {
                        // Password incorrect
                        return false;
                    }
                } else {
                    // User doesn't exist
                    return false;
                }
            } else {
                // No results
                return false;
            }
        }

        /**
         * Checks if a session is logged in and is a valid session
         * 
         * @param object $connection
         *            MySQL connection object
         * @return boolean result whether logged in with a valid session
         */
        public static function loginCheck($connection)
        {
            // Check session variables
            if (isset($_SESSION['userid'], $_SESSION['username'], $_SESSION['loginString'])) {
                
                // Collect values from session
                $userid = $_SESSION['userid'];
                $username = $_SESSION['username'];
                $loginString = $_SESSION['loginString'];
                // Get browser agent
                $browserAgent = $_SERVER['HTTP_USER_AGENT'];
                
                // Get user's password from database
                $sql = "SELECT password FROM users FROM id = ? LIMIT 1";
                
                // Prepare statement
                if ($result = $connection->prepare($sql)) {
                    // Bind ID into query
                    $result->bind_param('i', $userid);
                    // Execute query
                    $result->execute();
                    // Save results
                    $result->store_result();
                    
                    // Check if user exists
                    if ($result->num_rows == 1) {
                        // Get user's database password
                        $result->bind_result($password);
                        $result->fetch();
                        
                        // Hash dbpassword with agent
                        $dbpassword = hash('sha512', $password . $browserAgent);
                        
                        // Check password
                        if ($dbpassword == $loginString) {
                            // Logged in
                            return true;
                        } else {
                            // Invalid password
                            return false;
                        }
                    } else {
                        // User not found
                        return false;
                    }
                } else {
                    // No results
                    return false;
                }
            } else {
                // Invalid session
                return false;
            }
        }
    }
}
