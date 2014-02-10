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
 * Description: This file handles the login/registration process.
 * 
 */
namespace LastResortRecovery;

include_once 'db.php';
include_once 'session.php';

// Start a session
Session::startSecureSession();

// Check post variables
if (isset($_POST['email'], $_POST['password'])) {
    
    $email = $_POST['email'];
    // Encrypted password
    $password = $_POST['password'];
    
    // Check if login valid
    if (Session::login($email, $password, $connection)) {
        // Login success
        echo 'Login success';
    } else {
        // Login failed
        echo 'Login failed';
    }
} else {
    // Nothing was posted
    echo 'Bad request';
}
