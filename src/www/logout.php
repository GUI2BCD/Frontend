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
 * Description: This file handles the logout process
 *
 */

namespace LastResortRecovery;

include_once 'db.php';
include_once 'session.php';

Session::startSecureSession();

// Unset all session variables
$_SESSION = array();

// Delete cookie
$params = session_get_cookie_params();

setcookie(
    session_name(),
    '',
    time() - 42000,
    $params["path"],
    $params["domain"],
    $params["secure"],
    $params["httponly"]
);

// Destroy session
session_destroy();
header('Location: index.php');
