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
 *              This includes login authentication
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
            $sessionName = "lastresort";
            // Setup cookie parameters
            $cookieParams = session_get_cookie_params();
            session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], false, 
                true);
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
         * @return string whether the login was sucessful or approriate error
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
                        return LOGIN_SUCCESS;
                    } else {
                        // Password incorrect
                        return LOGIN_PASSWORD;
                    }
                } else {
                    // User doesn't exist
                    return LOGIN_EMAIL;
                }
            } else {
                // No results
                return DATABASE_ERROR;
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
                $sql = "SELECT password FROM users WHERE id = ? LIMIT 1";
                
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

        /**
         * Checks if a username is already in use
         *
         * @param string $username
         *            Username in question
         * @param string $connection
         *            MySQL connection object
         * @return string whether the username is in use or not
         */
        public static function checkUsername($username, $connection)
        {
            // Check if username exists
            $sql = "SELECT id FROM users WHERE username = ? LIMIT 1";
            
            // Prepare statement
            if ($result = $connection->prepare($sql)) {
                // Bind username into query
                $result->bind_param('s', $username);
                // Execute query
                $result->execute();
                // Save results
                $result->store_result();
                
                if ($result->num_rows == 1) {
                    // Username exists
                    return VALIDATION_USER;
                } else {
                    // Username doesn't exist
                    return VALIDATION_OK;
                }
            } else {
                return DATABASE_ERROR;
            }
        }

        /**
         * Checks if a email is already in use
         *
         * @param string $email
         *            Email in question
         * @param string $connection
         *            MySQL connection object
         * @return string whether the email is in use or not
         */
        public static function checkEmail($email, $connection)
        {
            
            // Validate email
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Invalid
                return VALIDATION_BAD_EMAIL;
            }
            
            // Check if email exists
            $sql = "SELECT id FROM users WHERE email = ? LIMIT 1";
            
            // Prepare statement
            if ($result = $connection->prepare($sql)) {
                // Bind email into query
                $result->bind_param('s', $email);
                // Execute query
                $result->execute();
                // Save results
                $result->store_result();
                
                if ($result->num_rows == 1) {
                    // Email exists
                    return VALIDATION_EMAIL;
                } else {
                    // Email doesn't exist
                    return VALIDATION_OK;
                }
            } else {
                return DATABASE_ERROR;
            }
        }

        /**
         * Checks if username & email is available and registers user into database
         *
         * @param string $username
         *            User's name
         * @param string $email
         *            User's email address
         * @param string $password
         *            User's password
         * @param object $connection
         *            MySQL connection object
         * @return string result whether registration was successful or approriate error
         */
        public static function register($username, $email, $password, $connection)
        {
            
            // Check if username already exists
            if (Session::checkUsername($username, $connection) == VALIDATION_USER) {
                return REGISTER_USER;
            }
            
            // Check if email valid
            if (Session::checkEmail($email, $connection) == VALIDATION_BAD_EMAIL) {
                return REGISTER_BAD_EMAIL;
            }
            
            // Check if email already exists
            if (Session::checkEmail($email, $connection) == VALIDATION_EMAIL) {
                return REGISTER_EMAIL;
            }
            
            // Create a salt to protect password
            $salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), true));
            
            // Salt password
            $password = hash('sha512', $password . $salt);
            
            // Insert user into database
            $sql = "INSERT INTO users (username, password, salt, email) VALUES( ?, ?, ?, ?)";
            
            // Prepare statement
            if ($result = $connection->prepare($sql)) {
                // Bind parameters
                $result->bind_param('ssss', $username, $password, $salt, $email);
                
                // Execute query
                if (! $result->execute()) {
                    return DATABASE_ERROR;
                }
                
                // Success
                return REGISTER_SUCCESS;
            } else {
                return DATABASE_ERROR;
            }
        }

        /**
         * Gets the id of user from an email
         * 
         * @param string $email
         *            User's email
         * @param object $connection
         *            MySQL connection object
         * @return string number or error
         */
        public static function getUserID($email, $connection)
        {
            
            // Get user's id
            $sql = "SELECT id FROM users WHERE email = ? LIMIT 1";
            
            // Prepare statement
            if ($result = $connection->prepare($sql)) {
                // Bind ID into query
                $result->bind_param('s', $email);
                // Execute query
                $result->execute();
                // Save results
                $result->store_result();
                
                // Check if user exists
                if ($result->num_rows == 1) {
                    // Get user's database password
                    $result->bind_result($id);
                    $result->fetch();
                    
                    return id;
                } else {
                    return - 1;
                }
            } else {
                return - 1;
            }
        }
    }
}
