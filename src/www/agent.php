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
 * Description: This file contains the functionality for the agent interacting with the website
 */
namespace LastResortRecovery;

include_once 'db.php';
include_once 'session.php';
include_once 'device.php';

// Start a session
Session::startSecureSession();

if (isset($_GET['action'])) {
    
    // Agent checking credentials
    if ($_GET['action'] == 'auth') {
        
        // Check post variables
        if (isset($_POST['email'], $_POST['password'])) {
            
            // User
            $email = $_POST['email'];
            // Encrypted password
            $password = $_POST['password'];
            
            // Check if login valid
            $result = Session::login($email, $password, $connection);
            if ($result == LOGIN_SUCCESS) {
                echo LOGIN_SUCCESS;
            } else {
                echo $result;
            }
        } else {
            echo BAD_REQUEST;
        }
    }     // Agent requesting status of device
    elseif ($_GET['action'] == 'status') {
        // Check post variables
        if (isset($_POST['email'], $_POST['password'], $_POST['deviceid'])) {
            
            // User
            $email = $_POST['email'];
            // Encrypted password
            $password = $_POST['password'];
            // Device
            $deviceid = $_POST['deviceid'];
            
            // Check if login valid
            $result = Session::login($email, $password, $connection);
            if ($result == LOGIN_SUCCESS) {
                // Check device status
                echo 'OK';
            } else {
                echo $result;
            }
        } else {
            echo BAD_REQUEST;
        }
    }     // Agent registering a new device
    elseif ($_GET['action'] == 'register') {
        // Check post variables
        if (isset($_POST['email'], $_POST['password'], $_POST['devicename'])) {
            
            // User
            $email = $_POST['email'];
            // Encrypted password
            $password = $_POST['password'];
            // Device
            $devicename = $_POST['devicename'];
            // Check if login valid
            $result = Session::login($email, $password, $connection);
            if ($result == LOGIN_SUCCESS) {
                // Register device
                echo Device::registerDevice($email, $devicename, $connection);
            } else {
                $result;
            }
        }
        else {
            echo BAD_REQUEST;
        }
    }
} else {
    echo BAD_REQUEST;
}