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
 * Description: This file will hold the global configuration variables
 */
namespace LastResortRecovery

{

    include 'db_config.php';
    
    // Error messages
    define("LOGIN_SUCCESS", "Logged in");
    define("LOGIN_PASSWORD", "Bad password");
    define("LOGIN_USER", "User not found");
    define("LOGIN_EMAIL", "Email not found");
    define("LOGIN_SESSION", "Invalid session");
    
    define("REGISTER_SUCCESS", "Registered");
    define("REGISTER_EMAIL", "Email in use");
    define("REGISTER_USER", "Username is use");
    define("REGISTER_BAD_EMAIL", "Email invalid");
    
    define("VALIDATION_USER", "false");
    define("VALIDATION_BAD_EMAIL", "false");
    define("VALIDATION_EMAIL", "false");
    define("VALIDATION_OK", "true");
    
    define("DATABASE_ERROR", "Database error");
    define("BAD_REQUEST", "Bad request");
    
    // Agent actions
    define("AGENT_AUTH", "AUTH");
    define("AGENT_REGISTER_USER", "Invalid user");
    define("AGENT_REGISTER_SUCCESS", "Device registered");
    define("AGENT_DEVICE", "Device not found");
    define("AGENT_REPORT", "Submitted");
    define("AGENT_REPORT_FAIL", "Failed to submit");
}
