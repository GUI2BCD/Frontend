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
 * Description: This file handles the AJAX calls for login/registration form
 *
 */
namespace LastResortRecovery;

include_once 'db.php';
include_once 'session.php';

// Check post variables
if (isset($_POST['username'])) {
    // Check username
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    echo Session::checkUsername($username, $connection);
} elseif (isset($_POST['email'])) {
    // Check email
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    echo Session::checkEmail($email, $connection);
} else {
    echo BAD_REQUEST;
}
