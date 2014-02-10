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
 * Description: This file contains all the functionality related to interacting
 *              with the database.
 */
namespace LastResortRecovery;

include_once 'db.php';
include_once 'session.php';

// Check post variables
if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
    
    // Sanitize input
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    
    // Validate email
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Invalid
        die(REGISTER_BAD_EMAIL);
    }
    
    // Perform register
    echo Session::register($username, $email, $password, $connection);
} else {
    echo 'Bad request';
}
